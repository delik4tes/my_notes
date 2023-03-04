; А-07-18 Бесараб А.А. Вариант 5
;Задан двумерный массив двухбайтовых целых чисел со знаком. 
;Определить минимальное значение элементов массива и его индексы.
.model small	; один сегмент кода, данных и стека
.stack 100h		; отвести под стек 256 байт

RowsCount = 5 	; количество строк в матрице
ColCount = 3 	; количество столбцов в матрице

ArrayStart EQU OFFSET Array
Zero EQU '0'
NewLineCode EQU 10
CarriageRetCode EQU 13

.data			; начало сегмента данных
	Array	dw	-0,23,22, 13,22,29,  -21020,57,64,  5,-100,76,  3,-1021,10 


.code			; начало сегмента кода

	; Начальная инициализация
	mov	ax, @data
	mov	ds, ax					; настройка DS на начало сегмента данных

	mov si, offset MinValue 		; установка SI на начало байтов с результатами
	mov bx, ArrayStart			; установка BX на начало массива
	
	xor ax, ax
	mov ax, [bx]				
	mov cs:[minValue], ax		; инициализируем минимальное значение первым элементом массива
	
	mov dh, 0					; текущая строка
	mov dl, 0					; текущий столбец
	
	ForeachRows:				; перебор строк
		mov dl, 0				; сброс текущего столбца
		ForeachCols:			; перебор столбцов
			mov ax, [bx]		; текущее значение массива
			mov cx, cs:[si]
			cmp cx, ax		; сравниваем с минимальным значением
			jle NextCol		; если текущее значение массива меньше минимального:
			mov cs:[minValue], ax		;устанавливаем новое минимальное значение
			mov cs:[minRowI], dh		;устанавливаем новый индекс строки минимального значения
			mov cs:[minColI], dl		;устанавливаем новый индекс столбца минимального значения
		NextCol:			; Переход к следующему элементу в строке
			inc bx				; переход к следующему элементу в памяти
			inc bx				
			inc dl				; следующий столбец
			cmp dl, ColCount	; если значение текущего столбца меньше количества столбцов:
			jl ForeachCols		; переход к следующему столбцу
		
	NextRow:		; иначе переход к следубщей строке
		inc dh					; следующая строка
		cmp dh, RowsCount		; если значение текущей строки меньше количества строк:
		jl ForeachRows		; переход к следующей строке
	
	

	test cs:[minValue], 8000h; проверяем число на отрицательность
	jz LogResult			; если неотрицательное, выводим результаты
	call ReverseNegative	; иначе форматируем число для корректного вывода
	call PrintMinus			; выводим минус

LogResult: 				; вывод результатов
	call LogMin
	mov dl, cs:[si+2]
	call LogIndex
	mov dl, cs:[si+3]
	call LogIndex
	
	; Стандартное завершение программы
	mov	ax, 4C00h			; ah = N функции, al = код возврата
	int	21h					; снять программу с выполнения

	ReverseNegative proc
		mov dx, cs:[minValue]
		mov ax, 0ffffh		; Вычитаем из 65536 полученное число
		sub ax, dx			
		inc ax
		mov cs:[minValue], ax		; заносим его в память
		ret
	endp

	PrintMinus proc
		mov dl, 2dh			; заносим в DL минус
		mov ah, 2			; выводим символ
		int 21h
		ret
	endp

	LogMin proc		; вывод числа
		mov dx, cs:[minValue]
		xor ax, ax			; обнуляем регистр ax
		mov ax, dx 			; загружаем в ax число для вывода
		xor dx, dx			; обнуляем регистр dx
		mov bx, 10000d 		; находим число десятков тысяч
		div bx
		mov cx, dx		; остаток после деления переносим в cx
		mov dx, ax		; целую часть переносим в dx 
		call PrintDigit 	; выводим ее
		
		xor ax, ax			; обнуляем регистр ax
		mov ax, cx  		; загружаем в ax остаток от прошлой операции
		xor dx, dx			; обнуляем регистр dx
		mov bx, 1000d 		; находим число тысяч
		div bx
		mov cx, dx		; остаток после деления переносим в cx
		mov dx, ax		; целую часть переносим в dx 
		call PrintDigit 	; выводим ее

		xor ax, ax			; обнуляем регистр ax
		mov ax, cx 			; загружаем в al число для вывода
		xor dx, dx			; обнуляем регистр dx
		mov bx, 100d 		; находим число сотен
		div bx
		mov cx, dx		; остаток после деления переносим в cx
		mov dx, ax		; целую часть переносим в dx 
		call PrintDigit 	; выводим ее
		
		xor ax, ax			; обнуляем регистр ax
		mov al, cl  		; загружаем в al остаток от прошлой операции
		mov dl, 10d			; находим число десятков
		div dl 
		mov cl, ah		; остаток после деления переносим в cl
		mov dl, al		; целую часть переносим в dl
		call PrintDigit 	; выводим ее
		
		mov dl, cl
		call PrintDigit 	; выводим единицы
		
		mov ah, 2			; делаем перевод строки
		mov dl, NewLineCode
		int 21h
		mov dl, CarriageRetCode
		int 21h
		ret
	endp
	
	LogIndex proc
	; байт для вывода - в dl
		xor ax,ax			; обнуляем регистр ax
		mov al, dl 			; загружаем в al число для вывода
		mov dl, 100d 		; находим число сотен
		div dl
		mov cl, ah		; остаток после деления переносим в cl
		mov dl, al		; целую часть переносим в dl
		call PrintDigit 	; выводим ее
		
		xor ax,ax			; обнуляем регистр ax
		mov al, cl  		; загружаем в al остаток от прошлой операции
		mov dl, 10d			; находим число десятков
		div dl 
		mov cl, ah		; остаток после деления переносим в cl
		mov dl, al		; целую часть переносим в dl
		call PrintDigit 	; выводим ее
		
		mov dl, cl
		call PrintDigit 	; выводим единицы
		
		mov ah, 2			; делаем перевод строки
		mov dl, NewLineCode
		int 21h
		mov dl, CarriageRetCode
		int 21h
		ret
	endp
	
	PrintDigit proc			; печать цифры
	; цифра для вывода - в dl
		add dl, Zero	; добавляем код нуля для перевода в символы чисел
		mov ah, 2			; выводим символ
		int 21h
		ret
	endp
	
	minValue dw (?)			; минимального значения
	minRowI db 0			; индекс строки минимального значения
	minColI db 0			; индекс столбца минимального значения

	end					; конец текста программы
