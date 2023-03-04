; Вишникина Ксения, группа А-07-18 ЛР4
; Вариант 6
; EXE файл

.model small		        ; один сегмент кода, данных и стека
;.stack 100h			      ; отвести под стек 256 байт
.code                   ; начало общего сегмента 
 	        
main:
  jmp start
  message db 'Hello, world!', '$'

start: 
  mov ax, @code 
  mov ss, ax            ; настраиваем стек на единый сегмент кодов
  push cs
  pop ds                ; настраиваем данные на единый сегмент 

  mov ah, 9
  mov dx, offset message
  int 21h               ; вывод строки на экран
  
; выход из программы
  mov ah, 4ch 
  int 21h 
  end main