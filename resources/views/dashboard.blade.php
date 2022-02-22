<body>
    <div class="d-flex">
        @include('layout')




        <div class="mt-5 text-center container d-flex flex-column justify-content-between" style="position: relative">


            <div>
                <h2 class="mb-4">
                    Choose File to Import
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
                <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">

                        <div class="my-1">
                            <label for="formFile" class="form-label"></label>
                            <input class="form-control" name="file" type="file" id="formFile">
                        </div>

                    </div>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Sample File
                    </button>
                    <button class="btn btn-primary">Import data</button>
                </form>
            </div>







            <div class="footer-container" style="position: absolute; left:0; bottom:0px; right:0">
                <footer class="footer footer-bottom ">

                    <div class="container footer-set ">

                        <div class="row p-2 " style="background-color: rgb(33, 37, 41); color: #fff">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                <p class="text-star"><a>Copyright © 2021-2022 </a><a href="#">Tridev</a>. All
                                    Rights
                                    Reserved.
                                </p>
                            </div>
                            <div class="col-12 col-sm-6 col-ms-6 col-lg-6 col-xl-6 col-xxl-6">
                                <p class="text-end"><a href="#">Back to top</a></p>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>





        </div>







    </div>


    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Sample File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="container-table" style="overflow: auto">
                        <table class="table ">
                            <thead>
                                <tr>

                                    <th scope="col">Txhash</th>
                                    <th scope="col">Blockno</th>
                                    <th scope="col">UnixTimestamp</th>
                                    <th scope="col">DateTime</th>
                                    <th scope="col">From</th>
                                    <th scope="col">To</th>
                                    <th scope="col">ContractAddress</th>
                                    <th scope="col">Value_IN(BNB)</th>
                                    <th scope="col">Value_OUT(BNB)</th>
                                    <th scope="col">TokenAmount</th>
                                    <th scope="col">TxnFee(BNB)</th>
                                    <th scope="col">TokenName</th>
                                    <th scope="col">TokenSymbol</th>
                                    <th scope="col">TokenID</th>
                                    <th scope="col">Method</th>
                                    <th scope="col">Status</th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>xxxxx</td>
                                    <td>12345</td>
                                    <td>1621188772</td>
                                    <td>16-05-2021 18.12</td>
                                    <td>xxxxx</td>
                                    <td>xxxxx</td>
                                    <td>abc</td>
                                    <td>00</td>
                                    <td>00</td>
                                    <td>00</td>
                                    <td>00</td>
                                    <td>abc</td>
                                    <td></td>
                                    <td></td>
                                    <td>abc</td>
                                    <td>abc</td>
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
