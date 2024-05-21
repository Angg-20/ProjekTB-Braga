<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="../../assets/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Tambahkan pustaka jQuery untuk mendukung fitur autocomplete -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        // Fungsi untuk melakukan autocomplete
        $(function() {
            $("#bookTitle").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "get_books.php",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 2 
            });
        });

        function hitungTotal() {
            var jumlah = parseInt(document.getElementById('jumlah').value);
            var harga = parseInt(document.getElementById('harga').value);
            var total = jumlah * harga;
            document.getElementById('total').value = total;

            var bayar = parseInt(document.getElementById('bayar').value);
            var kembalian = bayar - total;
            document.getElementById('kembalian').value = kembalian;
        }
    </script>
    </body>
</head>

<body class="sb-nav-fixed">