<body>
    <div class="d-flex">
        @include('layout')
        <div class="container mt-5 text-center">

            <table class="table text-center">
                <thead>
                    <tr>

                        <th scope="col">Sheet</th>
                        <th scope="col">Count</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataArr as $row)
                        {{-- {{ $row->batch }} --}}
                        <tr>

                            <td>{{ $row->batch }}</td>
                            <td>{{ $row->c }}</td>
                            <td>{{ $row->updated_at }}</td>
                            <td> <a href="{{ route('process-one', ['batch' => $row->batch]) }}"
                                    {{-- class="btn btn-primary rounded {{ $row->process_flag != '0' ? 'd-none' : '' }}">Process --}}
                                    class="btn btn-primary rounded">P 
                                    1</a>

                                <a href="{{ route('process-two', ['batch' => $row->batch]) }}"
                                    {{-- class="btn btn-primary rounded {{ $row->process_flag != '1' ? 'd-none' : '' }}">Process --}}
                                    class="btn btn-primary rounded">P 
                                    2</a>

                                <a href="{{ route('process-three', ['batch' => $row->batch]) }}"
                                    {{-- class="btn btn-primary rounded {{ $row->process_flag != '1' ? 'd-none' : '' }}">Process --}}
                                    class="btn btn-primary rounded">P
                                    3</a>

                                <a href="{{ route('view-individual', ['batch' => $row->batch]) }}"
                                    class="btn btn-primary rounded">View</a>
                            </td>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
</body>
