.model small
.stack 100h 
.data

port_address dw ? 		; ������� ����� ����� 
text_out db '0123456789',0Dh,'$' 	; ������������ ������
text_in db 50 dup(?) 		; ����� ��� ���������� ������ 
error_flag db ?			; ������� ������ ������

.code 
	; ========== ������������� ���������� ��������� ======================
	mov ax,@data 
	mov ds,ax 
	
	xor ax,ax 	; �.�. ����� ����� ��������� � ��. ������ 0000:0400h
	mov es,ax 		
	; ������ �������� ��������� ����� COM1 
	mov dx,es:[400h] 
	mov port_address,dx 

	; ���������� ������� � ��������� DLL � DLM (��������� DLAB=1) 
	; �������� DLL � DLM ������������ ��� ��������� �������� ��������/������. � ��� ��������� �������� D
	; ���������� ����� DLAB ������������ � �������� LCR.
	
	; ���������� ��� �������� LCR:
	; � ��� 7 � DLAB =1, ������ � ��������� DLL,DLM. 
	mov dx,port_address
	add dx,3 			; ����� �������� LCR 
	in al,dx 			; ���� ����������� �������� LCR � AL
	or al,10000000b 		; � ������� ������� AL - ������� 
	out dx,al 

	; ��������� �������� �������� 
	mov dx,port_address		; �������� �������� DLL = 0 
	mov al,192 			; ��������   D = 115200/V (V=600 bps)
	out dx,al 			; ������� ���� �������� � DLL 
	add dx,1 			; ����� �������� DLM 
	mov al,0 			; ������� ���� �������� � DLM 
	out dx,al 

	; ������ ������� � ��������� DLL � DLM, ��������� ����� ������ � �������� ����� 
	mov dx,port_address 
	add dx,3 
	mov al,00011111b 		; ��������� LCR
	out dx,al 			; 

	;������ ������ FIFO 
	mov dx,port_address 
	add dx,2 
	in al,dx 
	and al,0FEh ; ������������� ������� ��� � 0
	out dx,al

;========== �������� ======================
	; ��������� SI �� ������������ ������
	mov si,offset text_out 

output: 
	; ����� ���������� ����������� 
	mov dx,port_address 
	add dx,5 ; dx -> LSR
	in al,dx 
	; ���������� ��� �������� LSR
	; � ���7 = 0, ���� �������� ����� FIFO.
	; � ���6 � TEMPT =0, ���� ������� ����������� ����.
	; � ���5 � ���������� ������ ������ � ������� �����������.
	test al,00100000b		; ��������� ����� ��� �� ����������
	jz output 

	; �������� �������
	mov dx,port_address 
	mov al,[si] 
	out dx,al 

	inc si ; � ���������� �������

	cmp al,'$' 
	jnz output ; ����������, ���� �� �������� '$'

;============= �����   ============= 

	; ��������� SI �� �������� ����� 
	mov si,offset text_in 
	
input: 
	mov dx,port_address 
	add dx,5 		; ����� �������� LSR 
	in al,dx 
	test al,1h 		; ��������� �������� 0-�� ���� (���������� � ��������) 
	jz input 		; ���� � ��� 0 - ��������� �������� (����), ����� ��� ������ 

	and al,00000100b 	; ��������� ������ �������� 2-�� ���� LSR
	mov error_flag,al	; error_flag=0 ���� ������ ���

	; � ����� ������ ��������� ������ � ���������� � ������
	mov dx,port_address ; ����� �������� RBR 
	in al,dx 
	mov [si],al 

	cmp error_flag,0
	je no_error
 	mov al,'#'	; � ������ ������ ����� �������� ������� ������ �������
no_error:
	mov dl,al 	; ������ ����� ���������� �� dl

	; ����� �������, �������� � DL
	mov ah,06h 
	int 21h 


	inc si ; � ��������� ������� � ������

	cmp byte ptr [si-1],0Dh 
	jnz input ; ���������� ����, ���� �� ������ ������� ����� ��������� 0Dh 

;========== ����� ��������� ==============

	mov ax,4C00h 
	int 21h 

end
