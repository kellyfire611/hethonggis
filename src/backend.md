# Cách code Backend

## 1. Tạo model tương ứng với table/collection trong database
- Tạo file `app\Models\TinhThanh.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class TinhThanh.
 */
class TinhThanh extends Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tinhthanh';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tentinhthanh'];
}
```

## 2. Tạo repository chịu trách nhiệm thao tác CRUD
- Tạo file `app\Repositories\Backend\TinhThanhRepository.php`
```php
```

## 3. Tạo Request để kiểm tra validate dữ liệu
- Tạo file `app\Http\Requests\Backend\TinhThanh\ManageTinhThanhRequest.php`
```php
<?php

namespace App\Http\Requests\Backend\TinhThanh;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageTinhThanhRequest.
 */
class ManageTinhThanhRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
```
- Tạo file `app\Http\Requests\Backend\TinhThanh\StoreTinhThanhRequest.php`
```php
<?php

namespace App\Http\Requests\Backend\TinhThanh;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreTinhThanhRequest.
 */
class StoreTinhThanhRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tentinhthanh'     => ['required', 'max:191'],
        ];
    }
}
```
- Tạo file `app\Http\Requests\Backend\TinhThanh\UpdateTinhThanhRequest.php`
```php
<?php

namespace App\Http\Requests\Backend\TinhThanh;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateTinhThanhRequest.
 */
class UpdateTinhThanhRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tentinhthanh' => ['required', 'email', 'max:191'],
        ];
    }
}
```

## 4. Tạo controller
- Tạo file `app\Http\Controllers\Backend\TinhThanhController.php`
```php

```

## 5. Tạo route
Mỗi chức năng sẽ có URL tương ứng với route. Ví dụ tạo route chức năng danh mục Tỉnh thành có dạng như sau:
- http://localhost:8000/admin/tinhthanh
- http://localhost:8000/admin/tinhthanh/create
- http://localhost:8000/admin/tinhthanh/1/edit

Cách thực hiện:
- Hiệu chỉnh file `routes\backend\admin.php`
```php
use App\Http\Controllers\Backend\TinhThanhController;

// Route Tỉnh thành
Route::get('tinhthanh', [TinhThanhController::class, 'index'])->name('tinhthanh.index');
Route::get('tinhthanh/create', [TinhThanhController::class, 'create'])->name('tinhthanh.create');
Route::post('tinhthanh', [TinhThanhController::class, 'store'])->name('tinhthanh.store');
Route::get('tinhthanh/{tinhthanh}/', [TinhThanhController::class, 'show'])->name('tinhthanh.show');
Route::get('tinhthanh/{tinhthanh}/edit', [TinhThanhController::class, 'edit'])->name('tinhthanh.edit');
Route::patch('tinhthanh/{tinhthanh}/', [TinhThanhController::class, 'update'])->name('tinhthanh.update');
Route::delete('tinhthanh/{tinhthanh}/', [TinhThanhController::class, 'destroy'])->name('tinhthanh.destroy');
```

## 6. Tạo route hỗ trợ Breadcrumb
- Thêm vào trong file `routes\breadcrumbs\backend\backend.php`
```php
// Tỉnh thành
Breadcrumbs::for('admin.tinhthanh.index', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push(__('labels.backend.tinhthanh.management'), route('admin.tinhthanh.index'));
});

Breadcrumbs::for('admin.tinhthanh.deleted', function ($trail) {
    $trail->parent('admin.tinhthanh.index');
    $trail->push(__('menus.backend.tinhthanh.deleted'), route('admin.tinhthanh.deleted'));
});

Breadcrumbs::for('admin.tinhthanh.create', function ($trail) {
    $trail->parent('admin.tinhthanh.index');
    $trail->push(__('labels.backend.tinhthanh.create'), route('admin.tinhthanh.create'));
});

Breadcrumbs::for('admin.tinhthanh.show', function ($trail, $id) {
    $trail->parent('admin.tinhthanh.index');
    $trail->push(__('menus.backend.tinhthanh.view'), route('admin.tinhthanh.show', $id));
});

Breadcrumbs::for('admin.tinhthanh.edit', function ($trail, $id) {
    $trail->parent('admin.tinhthanh.index');
    $trail->push(__('menus.backend.tinhthanh.edit'), route('admin.tinhthanh.edit', $id));
});
```

## 7. Tạo giao diện view
### 7.1. Tạo mới thư mục với tên tương ứng với chức năng. Tương ứng với từng giao diện, sẽ được đặt tên như sau:
    - `index.php`: giao diện hiển thị danh sách
    - `create.php`: giao diện hiển thị form để người dùng thêm mới dữ liệu
    - `update.php`: giao diện hiển thị form để người dùng hiệu chỉnh dữ liệu
- Ví dụ tạo giao diện cho chức năng `tinhthanh`:
    - `resources\views\backend\tinhthanh\index.php`
    - `resources\views\backend\tinhthanh\create.php`
    - `resources\views\backend\tinhthanh\edit.php`

### 7.2. Tạo route hỗ trợ Header Button và Breadcrumb
- Tạo file `resources\views\backend\tinhthanh\includes\breadcrumb-links.blade.php`
- Tạo file `resources\views\backend\tinhthanh\includes\header-buttons.blade.php`