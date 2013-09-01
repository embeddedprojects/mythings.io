
#include <stdlib.h>
#include <stdio.h>
#include <usb.h>
int main(){
usb_dev_handle *udev;
struct usb_bus *bus;
struct usb_device *dev;
char barcode[8];

// search for the scanner, open the device and claim interface
usb_init();
usb_find_busses();
usb_find_devices();
for( bus=usb_get_busses(); bus; bus = bus->next )
for( dev = bus->devices; dev; dev = dev->next )
if( dev->descriptor.idVendor==0x0111 && dev->descriptor.idProduct==0x0111 )
udev = usb_open(dev);
usb_detach_kernel_driver_np(udev, 0);
usb_claim_interface(udev, 0);
char tmp[255];
char str;
int i;
int timeout=0;



#define TIMEOUT 3
while(1)
{
	//prompt scanner until we get 8 bytes.
	while( usb_interrupt_read(udev,1,barcode,8,1000)!=8 ) 
	{
		timeout ++;
		if(timeout > TIMEOUT) {
			usb_release_interface(udev, 0);
			usb_close(udev);
			return 1;
		}
	}
	timeout=0;
	switch(barcode[2]){
		case 30: printf("1"); break;
		case 31: printf("2"); break;
		case 32: printf("3"); break;
		case 33: printf("4"); break;
		case 34: printf("5"); break;
		case 35: printf("6"); break;
		case 36: printf("7"); break;
		case 37: printf("8"); break;
		case 38: printf("9"); break;
		case 39: printf("0"); break;
		default: ;//printf("->%u",barcode[2]);
	}
	if(barcode[2]==40) break;
}
usb_release_interface(udev, 0);
usb_close(udev);
return 1;
}

