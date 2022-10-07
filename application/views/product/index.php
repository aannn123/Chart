<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>

    <div class="container-fluid" style="padding: 50px">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Chart</h5>

                <div class="mt-4 mb-5">
                    <form action="<?= base_url('product/index') ?>" method="GET">
                        <div class="row">
                            <div class="form-group col-3">
                                <label for="exampleInputEmail1" class="form-label">Area</label>
                                <select class="form-select select-area" multiple="multiple" name="area[]" id="area-select">
                                    <!-- <option selected value="">Semua</option> -->
                                    <?php foreach ($areaFilter as $item) { ?>
                                        <option value="<?= $item['area_id'] ?>"><?= $item['area_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-3">
                                <label for="exampleInputEmail1" class="form-label">Date From</label>
                                <input type="date" name="dateFrom" value="<?= $dateFrom ?>" class="form-control" id="dateFrom">
                            </div>

                            <div class="form-group col-3">
                                <label for="exampleInputEmail1" class="form-label">Date To</label>
                                <input type="date" name="dateTo" value="<?= $dateTo ?>" class="form-control" id="dateTo">
                            </div>

                            <div class="col-3 mt-auto">
                                <input type="submit" id="filter" value="View" class="btn btn-primary">
                                <a href="<?= base_url('product/index') ?>" class="btn btn-danger">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div>
                    <canvas id="myChart" height="100"></canvas>
                </div>

                <div class="mt-5">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Brand</th>
                                <?php foreach ($area as $item) { ?>
                                    <th><?= $item['area_name'] ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($brand as $br) { ?>
                                <tr>
                                    <td><?= $br['brand_name'] ?></td>
                                    <?php foreach ($area as $item) { ?>
                                        <?php foreach ($product as $val) { ?>
                                            <?php if ($item['area_name'] == $val['area_name'] && $br['brand_name'] == $val['brand_name']) { ?>
                                                <td><?= $val['compliance'] ?>%</td>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/js/jquery.min.js')  ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js')  ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js')  ?>"></script>
    <script src="<?= base_url('assets/js/chart.min.js')  ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-area').select2();
            $('.select-area').val([<?php echo $areaId ?>]).trigger('change');

        });
    </script>
    <script>
        Chart.register(ChartDataLabels);
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo $area_js ?>,
                datasets: [{
                    type: 'bar',
                    label: 'Value',
                    data: <?php echo $value_js ?>,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',

                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1,
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: Math.round,
                        formatter: (val) => {
                            return (val.slice(-1) == 0 ? Math.ceil(val) : val) + ' %';
                        },
                        font: {
                            weight: 'bold',
                            size: 12
                        }
                    }
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            $("#dateTo").click(function() {
                var dateForm = document.getElementById("dateFrom").value;
                $('#dateTo').attr('min', dateForm);
            })

            $("#filter").click(function() {
                var dateFrom = document.getElementById("dateFrom").value;
                var dateTo = document.getElementById("dateTo").value;
                if (dateFrom) {
                    document.getElementById("dateTo").required = true
                }
                if (dateTo) {
                    document.getElementById("dateFrom").required = true

                }
            })

        });
    </script>
</body>

</html>