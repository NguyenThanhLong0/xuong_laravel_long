<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Test</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container">
        <h1>Quản lý Transaction</h1>
        <hr>

        <h3>Bắt đầu giao dịch </h3>

        <form class="mb-3" action="/transaction/start" method="POST">
            @csrf
            <label class="form-control" for="amount">Amount:</label>
            <input class="form-control" type="number" name="amount" required><br>

            <label class="form-control" for="receiver_account">Receiver Account:</label>
            <input class="form-control" type="text" name="receiver_account" required><br>

            <button type="submit">Giao dịch</button>
        </form>


        <hr>
        <h3>Xác nhận giao dịch</h3>
        <form class="mb-3" action="/transaction/confirm" method="POST">
            @csrf
            <button type="submit">Xác nhận</button>
        </form>

        <hr>
        <h3>Hoàn thành giao dịch</h3>
        <form class="mb-3" action="/transaction/complete" method="POST">
            @csrf
            <button type="submit">Hoàn thành</button>
        </form>

        <hr>
        <h3>Hủy giao dịch </h3>
        <form class="mb-3" action="/transaction/cancel" method="POST">
            @csrf
            <button type="submit">Hủy giao dịch</button>
        </form>
    </div>
</body>

</html>
