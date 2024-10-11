-Sửa dụng chatgpt để tìm kn và tham khảo
1. Eloquent ORM là gì trong Laravel?
-Eloquent ORM (Object-Relational Mapping) là một công cụ mạnh mẽ của Laravel giúp bạn tương tác với cơ sở dữ liệu bằng cách sử dụng các đối tượng PHP thay vì viết các truy vấn SQL trực tiếp. Eloquent ánh xạ các bảng trong cơ sở dữ liệu thành các Model trong Laravel, giúp thao tác CRUD (Create, Read, Update, Delete) trở nên dễ dàng hơn. Eloquent cho phép bạn định nghĩa các mối quan hệ (relationship) giữa các bảng, và nó tự động hóa nhiều tác vụ liên quan đến truy vấn cơ sở dữ liệu.

2. Laravel Eloquent có các quy ước mặc định nào khi ánh xạ giữa tên model và bảng trong cơ sở dữ liệu?
Eloquent tuân theo một số quy ước mặc định khi ánh xạ giữa Model và bảng trong cơ sở dữ liệu:

-Tên bảng: Eloquent giả định tên bảng tương ứng với một Model là số nhiều của tên Model, tất cả viết thường. Ví dụ:

Model: Product -> Bảng: products
Model: Category -> Bảng: categories
Khóa chính: Eloquent mặc định tên khóa chính (primary key) là id.

-Dấu thời gian: Eloquent tự động sử dụng hai cột created_at và updated_at để quản lý thời gian tạo và cập nhật bản ghi.

3 .Làm thế nào để thay đổi tên bảng (table) và khóa chính (primary key) mặc định trong Eloquent?
Để thay đổi tên bảng và khóa chính mặc định trong Eloquent ORM:

-Thay đổi tên bảng: Mặc định, Eloquent sẽ sử dụng tên bảng là dạng số nhiều của tên model. Để thay đổi tên bảng, bạn cần khai báo thuộc tính $table trong model.

Ví dụ:
protected $table = 'ten_bang_moi';

-Thay đổi khóa chính: Eloquent mặc định sử dụng khóa chính là cột id. Nếu khóa chính của bảng có tên khác, ta cần khai báo thuộc tính $primaryKey trong model.

Ví dụ:
protected $primaryKey = 'ten_khoa_chinh';

4.CRUD với Eloquent ORM như nào?
Create:
Ta có thể sử dụng phương thức create() nếu đã khai báo thuộc tính $fillable trong model, để cho phép gán hàng loạt dữ liệu.

Read:
Sử dụng phương thức all(), find(), where(), hoặc các câu truy vấn khác để lấy dữ liệu từ bảng.
Update:

Update:
Sử dụng phương thức update() hoặc lấy đối tượng, sửa dữ liệu rồi dùng save() để lưu thay đổi.

Delete:
Sử dụng phương thức delete() để xóa bản ghi.