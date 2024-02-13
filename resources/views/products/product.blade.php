@extends('layouts.master')
@section('css')
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">New Process</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Products</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">

                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-sm-6 col-md-4 col-xl-3">
                            <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                                data-toggle="modal" href="#modaldemo8">Add Product</a>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">product name</th>
                                    <th class="wd-15p border-bottom-0">Section name</th>
                                    <th class="wd-15p border-bottom-0">description</th>
                                    <th class="wd-20p border-bottom-0">action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>

                                @foreach ($products as $x)
                                    <?php $i++; ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $x->product_name }}</td>
                                        <td>{{ $x->section->section_name }}</td>
                                        <td>{{ $x->description }}</td>
                                        <td>
                                            <div style="display: flex;">
                                                <div style="display: flex;">
                                                    <a class="btn btn-primary" type="submit" data-id="{{ $x->id }}"
                                                        data-product_name="{{ $x->product_name }}"
														data-section_name="{{$x->section->section_name}}"
                                                        data-description="{{ $x->description }}" data-toggle="modal"
                                                        href="#modaldemo9" title="Edit"><i
                                                            class="las la-pen"></i>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            
                                                    <form action="{{ route('products.destroy', $x->id) }}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button name="Submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="modal" id="modaldemo8">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">

                        <div class="modal-body">
                            <form action="{{ route('products.store') }}" method="post">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name">
                                </div>
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="" selected disabled> --Choose Section--</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{$section->section_name }}</option>
                                    @endforeach
                                </select>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Confirm</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- edit -->
            </div>


			  <div class="modal" id="modaldemo9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action='products/update' method="post">
                                {{ method_field('patch') }}
                                {{ csrf_field() }}
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="title">اسم المنتج :</label>

                                        <input type="hidden" class="form-control" name="pro_id" id="pro_id"
                                            value="">

                                        <input type="text" class="form-control" name="product_name"
                                            id="product_name">
                                    </div>

                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                                    <select name="section_name" id="section_name" class="custom-select my-1 mr-sm-2"
                                        required>
                                        @foreach ($sections as $section)
                                            <option>{{$section->section_name}}</option>
                                        @endforeach
                                    </select>

                                    <div class="form-group">
                                        <label for="des">ملاحظات :</label>
                                        <textarea name="description" cols="20" rows="5" id='description' class="form-control"></textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <!--/div-->
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>


    <script>
        $('#modaldemo8').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var product_name = button.data('product_name')
            var section_name = button.data('section_name')
            var pro_id = button.data('pro_id')
            var description = button.data('description')
            var modal = $(this)
            modal.find('.modal-body #product_name').val(product_name);
            modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #description').val(description);
            modal.find('.modal-body #pro_id').val(pro_id);
        })

	      $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var pro_id = button.data('pro_id')
            var product_name = button.data('product_name')
            var section_name = button.data('section_name')
			 var description = button.data('description')

            var modal = $(this)
			
			modal.find('.modal-body #section_name').val(section_name);
            modal.find('.modal-body #pro_id').val(pro_id);
            modal.find('.modal-body #product_name').val(product_name);
			 modal.find('.modal-body #description').val(description);
        })

     
    </script>
@endsection
