; Женюх Александр, группа А-07-19 ЛР5
; Вариант 6
; COM файл

.model tiny 		        ; один сегмент всего

.code                   ; начало общего сегмента 
  org 100h	  	        

main:
  jmp start
  message db 'Hello, world!', '$'

start:
  push cs
  pop ds
  
  mov ah, 9
  mov dx, offset message
  int 21h               ; вывод строки на экран

; выход из программы
  mov ah, 4ch 
  int 21h 
  end main