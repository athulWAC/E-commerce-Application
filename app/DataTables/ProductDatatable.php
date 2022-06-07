<?php

namespace App\DataTables;

// use App\Models\ProductDatatable;

use App\Models\Category;
use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $dataTable = datatables()
            ->eloquent($query);

        $dataTable->addColumn('select', function (Product $product) {
            $id  = $product->id;
            return '<input type="checkbox" class="dt_child_select toggle" data-id="' . $id . '" data-toggle="toggle">';
        });

        $dataTable->editColumn('action', function (Product $product) {
            $id  = $product->id;
            return '<a href="' . route('editProduct', ['id' => $id]) . '" title="edit" data-id="{{$product->id}}" class="sidebar-link warning" data-bs-toggle="modal"  ><i class="bi bi-pencil"></i> </a>
            <button type="button" data-id="' . $id . '" class=" deleteProduct sidebar-link btn " title="delete" ><i class="bi bi-trash"></i></button>';
        });

        $dataTable->editColumn('created_at', function (Product $product) {
            $date  = $product->created_at;
            $utc = $date;
            $time = strtotime($utc); //returns an integer epoch time: 1401339270
            $dt = date("M/d/Y", $time);
            // echo $dt->format('Y-m-d H:i:s'); // output = 2017-01-01 00:00:00

            return  $dt;
        });


        $dataTable->addColumn('image', function (Product $product) {
            $id  = $product->id;
            $image  = $product->image;
            $url = "storage\app\assets\products";
            // dd($url);
            return '<div class="avatar avatar-lg me-3">
            <a href="' . route('editProduct', ['id' => $id]) . '" data-id="{{$product->id}}" class="sidebar-link warning" data-bs-toggle="modal"  >
            <img src="storage\app\assets\products\\' . $image . '" alt="" srcset=""> </a>
            </div>';
        });

        $dataTable->rawColumns(['select', 'action', 'image']);
        return $dataTable;
    }



    /** Get query source of dataTable.
     * send data
     *
     * @param \App\Models\ProductDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery()->leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.id as id', 'products.created_at as created_at', 'products.image as image', 'products.name as product_name', 'products.price as price', 'categories.name as category_name');
    }



    /**
     * Optional method if you want to use html builder.
     * This is used for bouilding whole table featuers
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                'dom' => 'Bfrtip',
                'ordering' => false,
                'buttons' => [
                    'export',
                    'print',
                    'reset',
                    'delete',
                    // 'reload',
                ],
            ]);
    }


    /**
     * Get columns.
     * Listing of datatable columns from controller
     * for giving extra features to  column,  go up  to   public function dataTable($query)
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('select')->title('<input type="checkbox" class="dt_parent_select" data-id="" data-toggle="toggle" >'),
            Column::make('image'),
            Column::make('id')->orderable(true),
            Column::make('product_name')->name('products.name')->title('Product')->orderable(false),
            Column::make('category_name')->name('categories.name')->title('Category')->orderable(false),
            Column::make('price')->orderable(false),
            Column::make('created_at')->title('Added_date')->orderable(false),
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
        return 'Product_' . date('YmdHis');
    }
}
