# project-ismart
- project được tổ chức theo mô hình MVC và sử dụng php thuần
- csdl: mysql
## Hướng dẫn cài đặt project:
### Bước 1: Cấu hình host ảo:
- Vào C:\Windows\System32\drivers\etc\hosts thêm dòng vào dòng cuối cùng của file:  
`127.0.0.1 	    ismart.local `
- Vào C:\xampp\apache\conf\extra\httpd-vhost.conf và paste:
` <VirtualHost ismart.local:80>
   ServerAdmin webmaster@dummy-host2.example.com
   DocumentRoot "C:\xampp\htdocs\ismart.com\ismart.com"
  ServerName ismart.local
    ErrorLog "logs/dummy-host2.example.com-error.log"
    CustomLog "logs/dummy-host2.example.com-access.log" common
</VirtualHost>`

- Note: Tuỳ thuộc vào việc cài xampp ở đâu thì sẽ tìm file httpd-vhost.conf ở trong ổ đó.
- DocumentRoot: đường dẫn đến project trong thư mục htdoc
- servername: host vừa thêm ở file hosts. 
### Import csdl:
- Vào phpmysql tạo csdl có tên là: db_ismart.com
- import file sql vào database vừa tạo.
