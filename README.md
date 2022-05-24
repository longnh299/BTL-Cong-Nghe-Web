#Các bước cài đặt dự án :

Clone Project :git clone https://github.com/longnh299/lala.git

1. Load dependency từ composer.json : composer install
2. Tạo file .env ,copy file .env.example sang .Cấu hình file .env phù hợp với DB
3. Tạo key cho project : php artisan key:generate
4. Cache lại file .env : php artisan config:cache
5. Tạo DB : php artisan migrate
6. Tạo seed cho DB :php artisan db:seed (email :user001@gmail , password:lala để đăng nhập)
7. Cài đặt npm : npm install
8. Để thêm chạy được css :Thêm file vào trong thư mục public/css
9. Muốn sửa css/js : chạy lại npm run dev

#Các file của dự án :
###BE :làm việc ở thư mục app , database , resource/lang, route

* app/Http/Controllers : Viết các Controller chỉ để điều hướng ,k viết các hàm xử lí logic trong Controller.
* app/Http/Requests : Viết các Request
* app/Models : Viết các model
* app/Service : Viết các hàm xử lí logic
* app/Traits : Chứa các hàm được sử dụng lại nhiều lần
* database: Có các thư mục tạo database , fake dữ liệu
* resource/lang :Các file chứa các message
* route: Viết các route cho trang web

###FE :làm việc ở thư mục resource

* resource/js : Các file JS
* resource/css :Các file CSS
* resource/views/layout: layout Html cho trang web
* resource/views/pages: Các page Html của trang web
* public/images: Chứa các file .svg hoặc .png (Lưu ý sử dụng "{{asset("a/b/c")}}") ~ cd ->file "public/a/b/c"

##Preview

### 1. Login 
<img src="https://user-images.githubusercontent.com/45144876/169958469-15b3e079-5aa6-4688-9bfa-e7b739f075d1.png" alt ="login-screen" width="600"/>

### 2. Register 
<img src="https://user-images.githubusercontent.com/45144876/169959385-37a67673-2129-4715-9474-d98f3b71c050.png" alt="register-screen" width="600"/>

### 3. Homepage 
<img src="https://user-images.githubusercontent.com/45144876/169959977-425222f4-2741-4ce4-bfdd-167b55401c12.png" alt="homepage" width="800"/>

### 4. Member of board
<img src="https://user-images.githubusercontent.com/45144876/169960313-0cf5cd92-d2cc-4136-ab2a-7f09850fc121.png" alt="member-of-board" width="800"/>

### 5. Board detail
<img src="https://user-images.githubusercontent.com/45144876/169960539-fe1416b1-c5ef-40be-9963-097d45d90884.png" alt="board-detail" width="800"/>

### 6.Create column
<img src="https://user-images.githubusercontent.com/45144876/169960756-25a9056c-d6b1-4fe8-b870-cb0c73a95458.png" alt="create-column" width="800"/>

### 7. Create task
<img src="https://user-images.githubusercontent.com/45144876/169960974-c67be4c0-861d-47c4-ba31-96b27c03d8b8.png" alt="create-task" width="800"/>

### 8. Invite member
<img src="https://user-images.githubusercontent.com/45144876/169961175-dcb90f19-5f6b-4f53-b072-b69cfc55287a.png" alt="invite-member" width="800"/>

### 9. Move to another board
<img src="https://user-images.githubusercontent.com/45144876/169961397-8064e33c-fe99-4d9c-8cf2-290bb9597769.png" alt="move" width="800"/>

### 10. Search board

<img src="https://user-images.githubusercontent.com/45144876/169961671-767fa36e-6873-40f2-ab2e-cbd29b2357fa.png" alt="search" width="800"/>




