# Howto

You can use the method of the package you are using
I will introduce some examples of use
Please refer to composer.json for version

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

#### Transaction

```php
$db = \DB::getConnection();
try {
    $db->beginTransaction();
    $hoge->save()
    $hoge2->save()
    $hoge3->save()
    $db->commit();
} catch (\Exception $e) {
    $db->rollBack();
}
```

#### lastInsertId

```php
$Recipe->save();
$recipeId = $Recipe->getConnection()->getPdo()->lastInsertId();
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
    ->get_html(PAGING_THEMES_PATH);
```

```php
$this->data['reports'] = $Reports->findAllPerPage($page);
$this->data['pager'] = $Reports->paginationNav((int)$page, $this->siteUrl('report'))
    ->get_html(PAGING_THEMES_PATH);
```

themes file
/src/Slimvc/themes/default.php
```php
<?php
$theme['pre']      = '<nav><ul class="pagination">';
$theme['first']    = array('<li><a href="{url}{nr}">First</a></li> ', '<li class="disabled"><a>First</a></li>');
$theme['previous'] = array('<li><a href="{url}{nr}">&laquo;</a></li> ', '<li class="disabled"><a>&laquo;</a></li>');
$theme['numbers']  = array('<li><a href="{url}{nr}">{nr}</a></li> ', '<li class="active"><a href="#">{nr} <span class="sr-only">(current)</span></a></li>');
$theme['next']     = array('<li><a href="{url}{nr}">&raquo;</a></li>', '<li class="disabled"><a>&raquo;</a></li>');
$theme['last']     = array('<li><a href="{url}{nr}">Last</a></li>', '<li class="disabled"><a>Last</a></li>');
$theme['post']     = '</ul></nav>';

return $theme;
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

