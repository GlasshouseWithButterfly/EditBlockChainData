<body>
    <div class="d-flex">
        @include('layout')
        {{-- {{ $count }} --}}
        <div class="container mt-5 text-center">

            <h2 class="mb-4">
                Select Sheet and Choose File to Import
            </h2>


            @if ($errors->any())
                {{-- {{ $errors ? dd($errors) : null }} --}}
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



            <div class="form-data">
                <form action="{{ route('wallet-list') }}" method="POST" enctype="multipart/form-data">
                    @csrf



                    <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">

                        <div class="select_batch my-3">

                            <select class="form-select" id="sel_batch" name="sheet"
                                aria-label="Default select example">
                                <option value="">Select Sheet</option>
                                @foreach ($count as $item)
                                    <option id="b{{ $item->batch }}" value="{{ $item->batch }}">{{ $item->batch }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="my-1">
                            <label for="formFile" class="form-label"></label>
                            <input class="form-control" name="file" type="file" id="formFile">
                        </div>

                    </div>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Sample File
                    </button>
                    <button class="btn btn-primary" type="submit">Import data</button>
                </form>

            </div>

        </div>



        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Sample File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                    <div class="container-table text-center">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th scope="col">Sno.</th>
                                    <th scope="col">Wallet Key</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td >1</td>
                                    <td>xxxxxxx</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>



            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
</body>
