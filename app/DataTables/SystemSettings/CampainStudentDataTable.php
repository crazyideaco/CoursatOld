<?php

namespace App\DataTables\SystemSettings;

// use App\Models\SystemSettings/CampainStudentDataTable;

use App\User;
use Carbon\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CampainStudentDataTable extends DataTable
{
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
            ->addColumn('action', 'systemsettings/campainstudentdatatable.action')
            ->addColumn('courses', function ($row) {
                $courses_names = "";
                if ($row->year_id != null) {
                    if ($row->stutypes) {
                        $courses_names = $row->stutypes->pluck('name_ar')->implode('-');
                    }
                } elseif ($row->university_id != null) {
                    if ($row->stutypescollege) {
                        $courses_names = $row->stutypescollege->pluck('name_ar')->implode('-');
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
                            return $row->year->year_ar ?? 'لم يحدد';
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
            ->editColumn('is_online', function ($row) {
                return $row->getOnlineStatusAttribute();
            })
            ->editColumn('online_date', function ($row) {
                return $row->is_online == 1 && $row->online_date != null ? Carbon::parse($row->online_date)->format('Y-m-d g:i A') : '-';
            })
            ->editColumn('offline_date', function ($row) {
                return $row->is_online == 0 && $row->offline_date != null ? Carbon::parse($row->offline_date)->format('Y-m-d g:i A') : '-';
            })
            ->editColumn('created_at', function ($row) {
                return  $row->created_at ? $row->created_at->format('Y-m-d') : '';
            })
            ->rawColumns([
                'action',
                'courses',
                'centers',
                'category_id',
                'is_online',
                'online_date',
                'offline_date',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\SystemSettings/CampainStudentDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        // dd($this->campain->category_id);
        $studentData = $model->newQuery()->where("category_id", $this->campain->category_id)->where(["created_at", ">=", $this->campain->start_date], ["created_at", "<=", $this->campain->end_date]);
        if ($studentData->category_id == 1) {
            $studentData = $studentData->where('year_id', $this->campain->year_id)->where('Stage_id', $this->campain->Stage_id);
        }
        if ($studentData->category_id == 2) {
            $studentData = $studentData->where('college_id', $this->campain->college_id)->where(['university_id', $this->campain->university_id]);
        }

        return $studentData;
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
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title("الكود"),
            Column::make('name')->title('الاسم'),
            Column::make('phone')->title('رقم الهاتف'),
            Column::make('courses')->title('الكورسات'),
            Column::make('created_at')->title('تاريخ التسجيل'),
            Column::make('centers')->title('المنصة'),
            Column::make('category_id')->title('نوع التعليم'),
            Column::make('year')->title('السنة'),
            Column::make('device_id')->defaultContent('-')->title('رقم الجهاز')->visible(false),
            Column::make('is_online')->title('حالة الظهور'),
            Column::make('online_date')->title('تاريخ الظهور'),
            Column::make('offline_date')->title('تاريخ أخر ظهور'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),


            // Column::make('id'),
            // Column::make('name')->title('الاسم'),
            // // Column::make('code')->title('الكود'),
            // Column::make('phone')->title('رقم الهاتف'),
            // // Column::make('courses')->title('الكورسات'),
            // Column::make('created_at')->title('تاريخ التسجيل'),
            // Column::make("centers")->title("المنصة"),
            // Column::make("category_id")->title("نوع التعليم"),
            // Column::make("year")->title("السنة"),
            // Column::make("device_id")->defaultContent('-')->title("رقم الجهاز")->visible(false),
            // Column::make("is_online")->title("حالة الظهور"),
            // Column::make("online_date")->title("تاريخ الظهور"),
            // Column::make("offline_date")->title("تاريخ أخر ظهور"),
            // Column::computed('action')
            //     ->exportable(false)
            //     ->printable(false)
            //     ->width(60)
            //     ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SystemSettings/CampainStudent_' . date('YmdHis');
    }
}
