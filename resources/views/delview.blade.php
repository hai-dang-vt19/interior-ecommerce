<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card p-2">
            <table class="table table-hover table-dark text-center table-responsive">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center fs-4 text-danger">Select</th>
                    </tr>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>ID Product</th>
                        <th>Type Product</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selects as $key => $select)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $select->id }}</td>
                        <td>{{ $select->id_product }}</td>
                        <td>{{ $select->type_product }}</td>
                        <td>{{ number_format($select->price) }}</td>
                        <td>{{ $select->date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card p-2">
            <table class="table table-hover table-dark text-center table-responsive">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center fs-4 text-danger">Distinct</th>
                    </tr>
                    <tr>
                        <th>Type Product</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($distincts as $distinct)
                    <tr>
                        <td>{{ $distinct->type_product }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card p-2">
            <table class="table table-hover table-dark text-center table-responsive">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center fs-4 text-danger">Orderby</th>
                    </tr>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>ID Product</th>
                        <th>Type Product</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderbys as $key => $orderby)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $orderby->id }}</td>
                        <td>{{ $orderby->id_product }}</td>
                        <td>{{ $orderby->type_product }}</td>
                        <td>{{ number_format($orderby->price) }}</td>
                        <td>{{ $orderby->date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card p-2">
            <table class="table table-hover table-dark text-center table-responsive">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center fs-4 text-danger">Select Top, limit</th>
                    </tr>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>ID Product</th>
                        <th>Type Product</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectTops as $key => $selectTop)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $selectTop->id }}</td>
                        <td>{{ $selectTop->id_product }}</td>
                        <td>{{ $selectTop->type_product }}</td>
                        <td>{{ number_format($selectTop->price) }}</td>
                        <td>{{ $selectTop->date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card p-2">
            <table class="table table-hover table-dark text-center table-responsive">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center fs-4 text-danger">Max, Min, Count, Avg, Sum</th>
                    </tr>
                    <tr>
                        <th>Max</th>
                        <th>Min</th>
                        <th>Count</th>
                        <th>Avg (id)</th>
                        <th>Sum (id)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $maxs }}</td>
                        <td>{{ $mins }}</td>
                        <td>{{ $counts }}</td>
                        <td>{{ $avgs }}</td>
                        <td>{{ $sums }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card p-2">
            <table class="table table-hover table-dark text-center table-responsive">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center fs-4 text-danger">Where In</th>
                    </tr>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>ID Product</th>
                        <th>Type Product</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($whereIns as $key => $whereIn)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $whereIn->id }}</td>
                        <td>{{ $whereIn->id_product }}</td>
                        <td>{{ $whereIn->type_product }}</td>
                        <td>{{ number_format($whereIn->price) }}</td>
                        <td>{{ $whereIn->date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card p-2">
            <table class="table table-hover table-dark text-center table-responsive">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center fs-4 text-danger">Between</th>
                    </tr>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>ID Product</th>
                        <th>Type Product</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($betweens as $key => $between)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $between->id }}</td>
                        <td>{{ $between->id_product }}</td>
                        <td>{{ $between->type_product }}</td>
                        <td>{{ number_format($between->price) }}</td>
                        <td>{{ $between->date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card p-2">
            <table class="table table-hover table-dark text-center table-responsive">
                <thead>
                    <tr>
                        <th colspan="9" class="text-center fs-4 text-danger">Join</th>
                    </tr>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>ID Bill</th>
                        <th>ID Product</th>
                        <th>Name Product</th>
                        <th>Method</th>
                        <th>Bank</th>
                        <th>Material</th>
                        <th>Supplier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($joins as $key => $joins)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $joins->id }}</td>
                        <td>{{ $joins->id_bill }}</td>
                        <td>{{ $joins->id_product }}</td>
                        <td>{{ $joins->name_product }}</td>
                        <td>{{ $joins->method }}</td>
                        <td>{{ $joins->bank }}</td>
                        <td>{{ $joins->material }}</td>
                        <td>{{ $joins->supplier }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container mt-5">
        <div class="card p-2">
            <table class="table table-hover table-dark text-center table-responsive">
                <thead>
                    <tr>
                        <th colspan="9" class="text-center fs-4 text-danger">Join On (where)</th>
                    </tr>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>ID Bill</th>
                        <th>ID Product</th>
                        <th>Name Product</th>
                        <th>Method</th>
                        <th>Bank</th>
                        <th>Material</th>
                        <th>Supplier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($joinWhereOns as $key => $joinWhereOn)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $joinWhereOn->id }}</td>
                        <td>{{ $joinWhereOn->id_bill }}</td>
                        <td>{{ $joinWhereOn->id_product }}</td>
                        <td>{{ $joinWhereOn->name_product }}</td>
                        <td>{{ $joinWhereOn->method }}</td>
                        <td>{{ $joinWhereOn->bank }}</td>
                        <td>{{ $joinWhereOn->material }}</td>
                        <td>{{ $joinWhereOn->supplier }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>