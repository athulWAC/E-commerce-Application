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

        // $dataTable->editColumn('category_name', function (Product $product) {
        //     return $product->category_name;
        // });

        $dataTable->editColumn('action', function (Product $product) {
            $id  = $product->id;
            return '<a href="' . route('editProduct', ['id' => $id]) . '" data-id="{{$product->id}}" class="sidebar-link warning" data-bs-toggle="modal"  ><i class="bi bi-pencil"></i> </a>
            <button type="button" data-id="' . $id . '" class=" deleteProduct sidebar-link btn  "><i class="bi bi-trash"></i></button>';
        });

        $dataTable->rawColumns(['action']);
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
            ->select('products.id as id', 'products.name as product_name', 'products.price as price', 'categories.name as category_name');
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
                // 'pageLength' => 10,
                'buttons' => [
                    'export',
                    'print',
                    'reset',
                    'reload',
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

            Column::make('id')->orderable(true),
            Column::make('product_name')->name('products.name')->title('Product')->orderable(false),
            Column::make('category_name')->name('categories.name')->title('Category')->orderable(false)->width('200px'),
            Column::make('price')->orderable(false)->width('200px'),
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
