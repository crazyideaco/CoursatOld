<?php

namespace App\DataTables\Admin\SystemContent;

use App\Type;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TypesDataTable extends DataTable
{
    protected $view = "dashboard.types-basic_courses.";
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', $this->view . 'action')
            ->addIndexColumn()
            ->setRowId('id')
            ->editColumn('name_ar', function ($query) {
                return '<a href="' . route('subtypes', $query->id) . '">' .  $query->name_ar . '</a>';
            })
            ->addColumn('user', function ($query) {
                if ($query->user) {
                    return $query->user->name;
                } else {
                    return "غير محدد";
                }
            })
            ->addColumn('center', function ($query) {
                if ($query->center) {
                    return  $query->center->name ?? 'المنصه العامه';
                } else {
                    return 'المنصه العامه';
                }
            })
            ->addColumn('subject', function ($query) {
                if ($query->subject) {
                    return $query->subject->name_ar;
                } else {
                    return "غير محدد";
                }
            })
            ->addColumn('year', function ($query) {
                if ($query->year) {
                    return $query->year->year_ar;
                } else {
                    return "غير محدد";
                }
            })
            ->editColumn('created_at', function ($query) {
                return Carbon::parse($query->created_at)->diffForHumans();
            })
            ->rawColumns([
                'action',
                'name_ar',
                'user',
                'center',
                'subject',
                'year',
                'created_at',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin/SystemContent/TypesDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Type $model)
    {
        if (Auth::user() && Auth::user()->isAdmin == 'admin') {
            return $model->newQuery()->orderBy('created_at', 'desc');
        } else if (Auth::user() && Auth::user()->is_student == config('project_types.auth_user_is_student.basic_lecturer')) {
            return $model->newQuery()->orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->get();
        } else if (Auth::user() && Auth::user()->is_student == config('project_types.auth_user_is_student.center') && Auth::user()->category_id = config('project_types.system_category_type.category_id_basic')) {
            return $model->newQuery()->orderBy('created_at', 'desc')->where('center_id', Auth::user()->id)->get();
        } else {
            return $model->newQuery();
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin/SystemContent/Types_' . date('YmdHis');
    }
}
