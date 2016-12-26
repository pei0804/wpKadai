# Howto

## RoutingPattern
- [English](https://laravel.com/docs/4.2/routing)
- [japanese](https://readouble.com/laravel/4.2/ja/quick.html)

```php
// GET /hello
Route::get('hello/', function() {
    return 'Hello World';
});
```

```php
// GET /
Route::get('/', 'AuthController:login')->name('login');

// GET /login
Route::get('/login', 'AuthController:login')->name('login');

// GET /logout
Route::get('/logout', 'AuthController:logout')->name('logout');

// POST /login
Route::post('/login', 'AuthController:doLogin');
```

```php
// /report
Route::group('/report', function(){

    // GET /report
    Route::get('/', 'ReportController:index');

    // GET /report/create
    Route::get('/create', 'ReportController:create');

    // POST /report
    Route::post('/', 'ReportController:store');

    // GET /:id
    Route::get('/:id', 'ReportController:show');

    // GET /:id/edit
    Route::get('/:id/edit', 'ReportController:edit');

    // PUT /:id
    Route::put('/:id', 'ReportController:update');

    // GET /:id/delete
    Route::get('/:id/delete', 'ReportController:delete');

    // DELETE /:id
    Route::delete('/:id', 'ReportController:destroy');
});
```

```php
// auto Routing
// Please see the larlavel official document
Route::resource('/report', 'ReportController');
```

```php
// 404 err
App::notFound(function(){
    View::display('404.twig');
});
```

## Database

- [English](https://laravel.com/docs/4.2/eloquent)
- [japanese](https://readouble.com/laravel/4.2/ja/eloquent.html)

### Model Example

```php
use Slimvc\Base\Model;

class Reportcates extends Model {

    protected $table = 'reportcates';
    protected $fillable = ['rc_name', 'rc_note' ,'rc_list_flg', 'rc_order'];

    public function reports()
    {
        return $this->hasMany('Reports');
    }
}
```

### QueryExample

```php
$Reports = new Reports();
$findReport = $Reports::find($id);
$this->data['title'] = 'report_id:' . $findReport->id;
$this->data['report'] = $findReport;
App::render('report/show.twig', $this->data);
```

```php
$findReports = $Reports->newQuery()->orderBy('created_at', 'desc');
```

### Validation

- [English](https://laravel.com/docs/4.2/validation)
- [japanese](https://readouble.com/laravel/4.2/ja/validation.html)

```php
$Reports = new Reports();
$input = Input::post();
$Reports->load($input);
$Reports->validate();
if (!$Reports->hasErrors()) {
    $Reports->save();
    App::flash('messageSuccess', "compleate");
    Response::redirect($this->siteUrl('report'));
} else {
    App::flash('messageError', $Reports->getErrors());
}
```

#### setting

```php
protected static function rules()
{
    return [];
}

protected static function messages()
{
    return [
        'required' => 'required!!!',
        'integer' => 'intintint',
    ];
}
```

## Paging

- [English](https://github.com/Modularr/Flexible-PHP-Pagination)

```php
$findReports = $Reports->newQuery()->orderBy('rp_date', 'desc');
$this->data['reports'] = $Reports->findByQueryPerPage($findReports, $page);
$this->data['pager'] = $Reports->paginationNav((int)$page, $this->siteUrl('report'))
    ->numbers('<li><a href="{url}{nr}">{nr}</a>', '<li class="active"><span>{nr}</span></li>');
```

```php
$this->data['reports'] = $Reports->findAllPerPage($page);
$this->data['pager'] = $Reports->paginationNav((int)$page, $this->siteUrl('report'))
    ->numbers('<li><a href="{url}{nr}">{nr}</a>', '<li class="active"><span>{nr}</span></li>');
```

## Migration

- [English](http://kohkimakimoto.github.io/lib-migration/documentation.html)

```bash
$ php vendor/bin/phpmigrate create create_sample_table
$ php vendor/kohkimakimoto/lib-migration/bin/phpmigrate up
$ php vendor/kohkimakimoto/lib-migration/bin/phpmigrate down

OR

$ composer db-up
$ composer db-down
```

## View

```
```

## Modules

```
```

## User Auth

```
```

## CSRF

```
```

