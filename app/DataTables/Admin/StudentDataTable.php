<?php

namespace App\DataTables\Admin;

use App\User;
use Illuminate\Http\Request as HttpRequest;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable
{
    protected $view = "dashboard.students.";
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query, HttpRequest $request)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', $this->view . 'action')
            ->addColumn('courses', function ($row) {
                $courses_names = "";
                if ($row->year_id != null) {
                    if ($row->stutypes) {
                        $courses_names = $row->stutypes->pluck('name_ar')->implode('-');
                        // foreach ($row->stutypes as $type) {
                        //     $type->name_ar;
                        // }
                    }
                } elseif ($row->university_id != null) {
                    if ($row->stutypescollege) {
                        $courses_names = $row->stutypescollege->pluck('name_ar')->implode('-');
                        // foreach ($row->stutypescollege as $typecollege) {
                        //     $typecollege->name_ar;
                        // }
                    }
                }
                return $courses_names;
            })
            ->addColumn('centers', function ($row) {
                $centers = "المنصة العامة";
                if (count($row->stdcenters) > 0) {
                    $centers = implode('-', $row->stdcenters->pluck('name')->toArray());
                }
                return $centers;
            })
            ->editColumn('category_id', function ($row) {
                return $row->category_id == config('project_types.system_category_type.category_id_college') ? 'جامعي' : 'أساسي';
            })
            ->addColumn('year', function ($row) {
                switch ($row->category_id) {
                    case config('project_types.system_category_type.category_id_basic'):
                        if ($row->year_id != null) {
                            return $row->year->name_ar ?? 'لم يحدد';
                        }
                        break;
                    case config('project_types.system_category_type.category_id_college'):
                        if ($row->section_id != null) {
                            return $row->section->name_ar ?? 'لم يحدد';
                        }
                        break;
                    default:
                        return 'لم يحدد';
                        break;
                }
            })
            ->editColumn('created_at', function ($row) {
                return  $row->created_at ? $row->created_at->format('Y-m-d') : '';
            })
            ->rawColumns([
                'action',
                'courses',
                'centers',
                'category_id',
            ])
            ->filter(function ($query) use ($request) {
                $query
                    ->when($request->stage_id != null && $request->stage_id != 0, function ($q) use ($request) {
                        // dd($request->all());
                        return $q->where('stage_id', (int)$request->stage_id);
                    })
                    ->when($request->year_id != null && $request->year_id != 0, function ($q) use ($request) {
                        return $q->where('year_id', (int)$request->year_id);
                    })
                    ->when($request->type_id != null, function ($q) use ($request) {

                        return $q->whereHas('stutypes', function ($typeq) use ($request) {
                            return $typeq->where('types.id', (int)$request->type_id);
                        });
                    })
                    ->when($request->university_id != null && $request->university_id != 0, function ($q) use ($request) {
                        return $q->where('university_id', (int)$request->university_id);
                    })
                    ->when($request->college_id != null && $request->college_id != 0, function ($q) use ($request) {
                        return $q->where('college_id', (int)$request->college_id);
                    })
                    ->when($request->division_id != null && $request->division_id != 0, function ($q) use ($request) {
                        return $q->where('division_id', (int)$request->division_id);
                    })
                    ->when($request->section_id != null && $request->section_id != 0, function ($q) use ($request) {
                        return $q->where('section_id', (int)$request->section_id);
                    })
                    ->when($request->type_college_id != null && $request->type_college_id != 0, function ($q) use ($request) {
                        return $q->whereHas('stutypescollege', function ($typeq) use ($request) {
                            return $typeq->where('typescollege.id', (int)$request->type_college_id);
                        });
                    })
                ;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin/StudentDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery()->where('is_student', config('project_types.auth_user_is_student.student'))->where('name', '<>', NULL)->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            // ->setTableId('admin/studentdatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1)
            // ->orderBy('id', 'desc')
            ->lengthMenu([[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]]);
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
            Column::make('name')->title('الاسم'),
            Column::make('code')->title('الكود'),
            Column::make('phone')->title('رقم الهاتف'),
            // Column::make('courses')->title('الكورسات'),
            Column::make('created_at')->title('تاريخ التسجيل'),
            Column::make("centers")->title("المنصة"),
            Column::make("category_id")->title("نوع التعليم"),
            Column::make("year")->title("السنة"),
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
        return 'Admin/Student_' . date('YmdHis');
    }
}
