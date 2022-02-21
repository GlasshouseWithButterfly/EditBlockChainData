<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Admin Panel</title>
</head>

<body>

    <div class="container">
        <div class="d-flex justify-content-between mt-5 mb-1 ">


            <h1 class="display-6">Sheet : {{ $data[0]->batch }}</h1>
            <div class="p-2">
                <a href="{{ route('view-list') }}" class="btn btn-success rounded">Go Back</a>
                <a href="{{ route('file-export', ['batch'=> $data[0]->batch, 'process'=>$data[0]->process_flag]) }}" class="btn btn-primary rounded">Export</a>
            </div>

        </div>

        <div class="container mt-4 mb-1 text-center fixed-scrollbar-container" style="overflow: auto">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
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
                    @foreach ($data as $item)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $item->Txhash }}</td>
                            <td>{{ $item->Blockno }}</td>
                            <td>{{ $item->UnixTimestamp }}</td>
                            <td>{{ $item->DateTime }}</td>
                            <td>{{ $item->From_Address }}</td>
                            <td>{{ $item->To_Address }}</td>
                            <td>{{ $item->ContractAddress }}</td>
                            <td>{{ $item['Value_IN(BNB)'] }}</td>
                            <td>{{ $item['Value_OUT(BNB)'] }}</td>
                            <td>{{ $item->TokenAmount }}</td>
                            <td>{{ $item['TxnFee(BNB)'] }}</td>
                            <td>{{ $item->TokenName }}</td>
                            <td>{{ $item->TokenSymbol }}</td>
                            <td>{{ $item->TokenID }}</td>
                            <td>{{ $item->Method }}</td>
                            <td>{{ $item->Status }}</td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
<script>
    $(function($){
	var fixedBarTemplate = '<div class="fixed-scrollbar"><div></div></div>';
	var fixedBarCSS = { display: 'none', overflowX: 'scroll', position: 'fixed',  width: '100%', bottom: 0 };
	
	$('.fixed-scrollbar-container').each(function() {
		var $container = $(this);
		var $bar = $(fixedBarTemplate).appendTo($container).css(fixedBarCSS);
		
		$bar.scroll(function() {
			$container.scrollLeft($bar.scrollLeft());
		});
		
		$bar.data("status", "off");
	});
	
	var fixSize = function() {
		$('.fixed-scrollbar').each(function() {
			var $bar = $(this);
			var $container = $bar.parent();
			
			$bar.children('div').height(1).width($container[0].scrollWidth);
			$bar.width($container.width()).scrollLeft($container.scrollLeft());
		});
	};
	
	$(window).on("load.fixedbar resize.fixedbar", function() {
		fixSize();
	});
	
	var scrollTimeout = null;
	
	$(window).on("scroll.fixedbar", function() { 
		clearTimeout(scrollTimeout);
		scrollTimeout = setTimeout(function() {
			$('.fixed-scrollbar-container').each(function() {
				var $container = $(this);
				var $bar = $container.children('.fixed-scrollbar');
				
				if($bar.length) {
					var containerOffset = {top: $container.offset().top, bottom: $container.offset().top + $container.height() };
					var windowOffset = {top: $(window).scrollTop(), bottom: $(window).scrollTop() + $(window).height() };
					
					if((containerOffset.top > windowOffset.bottom) || (windowOffset.bottom > containerOffset.bottom)) {
						if($bar.data("status") == "on") {
							$bar.hide().data("status", "off");
						}
					} else {
						if($bar.data("status") == "off") {
							$bar.show().data("status", "on");
							$bar.scrollLeft($container.scrollLeft());
						}
					}
				}
			});
		}, 50);
	});
	
	$(window).trigger("scroll.fixedbar");
});
</script>


</body>

</html>
