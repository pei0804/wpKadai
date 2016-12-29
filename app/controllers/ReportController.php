<?php

use Slimvc\Base\Controller;

Class ReportController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['isLogin']) || !isset($_SESSION['usName']) || !isset($_SESSION['usId'])) {
            Response::redirect($this->siteUrl('/'));
        }
        $this->data['user']['name'] = $_SESSION['usName'];
        $this->data['user']['id'] = $_SESSION['usId'];
    }

    public function index()
    {
        $page = (int)Input::get('page');
        $this->data['title'] = 'レポート';
        $Reports = new Reports();
        try {
            $findReports = $Reports->newQuery()->orderBy('rp_date', 'desc');
            $this->data['reports'] = $Reports->findByQueryPerPage($findReports, $page);
            $this->data['pager'] = $Reports->paginationNav((int)$page, $this->siteUrl('report'))
                ->get_html(PAGING_THEMES_PATH);
            App::render('report/index.twig', $this->data);
        } catch (\SQLiteException $e) {
            App::flash('messageError', "データベースエラーが発生しました。管理者にお問い合わせください。");
            Response::redirect($this->siteUrl('report'));
        }
    }

    public function show($id)
    {
        $Reports = new Reports();

        try {
            $findReport = $Reports::findOrFail($id);
            $this->data['title'] = 'レポートID：' . $findReport->id;
            $this->data['report'] = $findReport;
            App::render('report/show.twig', $this->data);
        } catch (\SQLiteException $e) {
            App::flash('messageError', "データベースエラーが発生しました。管理者にお問い合わせください。");
            Response::redirect($this->siteUrl('report'));
        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            App::flash('messageError', "存在しないレポートが指定されました。");
            Response::redirect($this->siteUrl('report'));
        }
    }

    public function create()
    {
        $this->data['title'] = 'レポート新規作成';
        $Reportcates = new Reportcates();
        try {
            $this->data['reportcates'] = $Reportcates->all();
            App::render('report/create.twig', $this->data);
        } catch (\SQLiteException $e) {
            App::flash('messageError', "データベースエラーが発生しました。管理者にお問い合わせください。");
            Response::redirect($this->siteUrl('report'));
        }

    }

    public function store()
    {
        $Reports = new Reports();
        $input = Input::post();
        $input["rp_date"] = $input["rp_date_year"] . "-" . $input["rp_date_month"] . "-" . $input["rp_date_day"];
        $input["rp_time_from"] = $input["rp_time_from_hour"] . ":" . $input["rp_time_from_min"] . ":00";
        $input["rp_time_to"] = $input["rp_time_to_hour"] . ":" . $input["rp_time_to_min"] . ":00";
        $input['rp_created_at'] = date('Y-m-d H:i:s');
        $Reports->load($input);
        try {
            $Reports->validate();
            if (!$Reports->hasErrors()) {
                $Reports->save();
                App::flash('messageSuccess', "登録が完了しました");
                Response::redirect($this->siteUrl('report'));
            } else {
                throw new \Exception;
            }
        } catch (\SQLiteException $e) {
            App::flash('messageError', "データベースエラーが発生しました。管理者にお問い合わせください。");
            Response::redirect($this->siteUrl('report'));
        } catch (\Exception $e) {
            App::flash('messageError', "入力内容に誤りがあります");
            App::flash('errors', $Reports->errors);
            App::flash('input', $input);
            Response::redirect($this->siteUrl('report/create'));
        }
    }

    public function edit($id)
    {
        $Reports = new Reports();

        try {
            $findReport = $Reports::findOrFail($id);
            $this->data['report'] = $findReport;
            $this->data['title'] = '［編集］レポートID：' . $findReport->id;
        } catch (\SQLiteException $e) {
            App::flash('messageError', "データベースエラーが発生しました。管理者にお問い合わせください。");
            Response::redirect($this->siteUrl('report'));
        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            App::flash('messageError', "存在しないレポートが指定されました。");
            Response::redirect($this->siteUrl('report'));
        }

        $Reportcates = new Reportcates();
        $this->data['reportcates'] = $Reportcates->all();
        App::render('report/edit.twig', $this->data);
    }

    public function update($id)
    {
        $input = Input::put();
        $Reports = new Reports();
        $input["rp_date"] = $input["rp_date_year"] . "-" . $input["rp_date_month"] . "-" . $input["rp_date_day"];
        $input["rp_time_from"] = $input["rp_time_from_hour"] . ":" . $input["rp_time_from_min"] . ":00";
        $input["rp_time_to"] = $input["rp_time_to_hour"] . ":" . $input["rp_time_to_min"] . ":00";
        $Reports->load($input);

        try {
            $Reports->validate();
            if (!$Reports->hasErrors()) {
                $Reports->newQuery()
                    ->where('id', $input['id'])
                    ->update($Reports->toArray());
                App::flash('messageSuccess', "変更が完了しました");
                Response::redirect($this->siteUrl('report') . '/' . $id);
            } else {
                throw new \Exception;
            }
        } catch (\SQLiteException $e) {
            App::flash('messageError', "データベースエラーが発生しました。管理者にお問い合わせください。");
            Response::redirect($this->siteUrl('report'));
        } catch (\Exception $e) {
            App::flash('messageError', "入直内容に誤りがあります");
            App::flash('errors', $Reports->errors);
            App::flash('input', $input);
            Response::redirect($this->siteUrl('report/edit') . '/' . $input['id']);
        }
    }

    public function delete($id)
    {
        $Reports = new Reports();
        try {
            $findReport = $Reports::find($id);
            $this->data['title'] = '［削除］レポートNo：' . $findReport->id;
            $this->data['report'] = $findReport;
            App::render('report/destroy.twig', $this->data);
        } catch (\SQLiteException $e) {
            App::flash('messageError', "データベースエラーが発生しました。管理者にお問い合わせください。");
            Response::redirect($this->siteUrl('report'));
        }
    }

    public function destroy()
    {
        $input = Input::delete();
        $Reports = new Reports();

        try {
            $Reports->findOrFail($input);
            $Reports->find($input['id'])->delete();
            App::flash('messageSuccess', "削除が完了しました");
            Response::redirect($this->siteUrl('report'));
        } catch (\SQLiteException $e) {
            App::flash('messageError', "データベースエラーが発生しました。管理者にお問い合わせください。");
            Response::redirect($this->siteUrl('report'));
        } catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            App::flash('messageError', "存在しないレポートが指定されました。");
            Response::redirect($this->siteUrl('report'));
        } catch (\Exception $e) {
            App::flash('messageError', "削除に失敗しました。");
            Response::redirect($this->siteUrl('report/destroy') . '/' . $input['id']);
        }
    }
}