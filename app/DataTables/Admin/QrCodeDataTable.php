<?php

namespace App\DataTables\Admin;

use App\Models\QrCode;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class QrCodeDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query)
    {
        return datatables()
        ->eloquent($query)

        // ->addColumn('action', 'admin_dashboard.orders.action')
        ->rawColumns([
            'action',
        ]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(QrCode $model): QueryBuilder
    {
        return $model->newQuery()->orderBy("id", "desc")->where('patch_id',$this->id)
        ;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html()
    {
        return $this->builder()
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->parameters([
            'dom' => 'Blfrtip',
            'order' => [0, 'desc'],
            'lengthMenu' => [
                [10,25,50,-1],[10,25,50,'all record']
            ],
       'buttons'      => ['export'],
   ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            ["data" => "id" ,"title" => 'code number','orderable'=>false,'searchable'=>false],
            ["data" => "qrcode" ,"title" => 'qrcode','orderable'=>false,'searchable'=>false],
            ["data" => "date_format" ,"title" => 'print date','orderable'=>false,'searchable'=>false],
            ["data" => "expire_date_format" ,"title" => 'expire date','orderable'=>false,'searchable'=>false],
            ["data" => "status_format" ,"title" => 'status','orderable'=>false,'searchable'=>false],

            // ['data'=>'action','title'=>__("messages.actions"),'printable'=>false,'exportable'=>false,'orderable'=>false,'searchable'=>false],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ProductQrCode_' . date('YmdHis');
    }
}
