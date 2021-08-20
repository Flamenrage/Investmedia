@extends('admin.layouts.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Welcome page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Welcome page</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Title</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                Start creating your amazing application!
            </div>
            <!-- /.card-body -->


            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <div class="card col-lg-8 col-md-8 col-sm-12">
            <div class="card-header">
                <h3 class="card-title">Bar chart</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="container" style="width: 80%;">
                    <canvas id="canvas"></canvas>
                    <button type="button" class="btn btn-primary mt-2" id="download-pdf">
                        Download PDF
                    </button>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
                <script>
                    Chart.plugins.register({
                        beforeDraw: function (chartInstance) {
                            var ctx = chartInstance.chart.ctx;

                            ctx.fillStyle = "white";
                            ctx.fillRect(0, 0, chartInstance.chart.width, chartInstance.chart.height);
                        }
                    });
                    var chartdata = {
                        type: 'bar',
                        data: {
                            labels: <?php echo json_encode($cats); ?>,
                            // labels: month,
                            datasets: [
                                {
                                    label: 'posts count',
                                    backgroundColor: '#26b99a',
                                    borderWidth: 1,
                                    data: <?php echo json_encode($data); ?>
                                }
                            ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        stepSize: 1,
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    }
                    var ctx = document.getElementById('canvas').getContext('2d');
                    new Chart(ctx, chartdata);

                    //add event listener to button
                    document.getElementById('download-pdf').addEventListener("click", downloadPDF);

                    //donwload pdf from original canvas
                    function downloadPDF() {
                        var canvas = document.querySelector('#canvas');
                        //creates image
                        var canvasImg = canvas.toDataURL("image/jpeg", 1.0);

                        //creates PDF from img
                        var doc = new jsPDF('landscape');
                        doc.setFontSize(20);
                        doc.text(15, 15, "Bar Chart");
                        doc.addImage(canvasImg, 'JPEG', 10, 10, 280, 150);
                        doc.save('canvas.pdf');
                    }

                    var gradient = ctx.createLinearGradient(0, 0, 0, 300);
                    gradient.addColorStop(0, 'rgb(171,219,255)');
                    gradient.addColorStop(1, 'rgba(170, 219, 255,0.3)');

                    var chartdata = {
                        type: 'line',
                        data: {
                            labels: <?php echo json_encode($cats); ?>,
                            // labels: month,
                            datasets: [
                                {
                                    borderWidth: 3,
                                    label: 'posts count',
                                    backgroundColor: gradient,
                                    data: <?php echo json_encode($data); ?>
                                }
                            ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        stepSize: 1,
                                        beginAtZero: true,
                                    }
                                }]
                            },
                            elements: {
                                line: {
                                    tension: 0 // disables bezier curves
                                }
                            },
                        }
                    }
                    var ctx = document.getElementById('canvas2').getContext('2d');
                    new Chart(ctx, chartdata);


                </script>
            </div>
            <!-- /.card-body -->
        </div>

        <div class="card col-lg-8 col-md-8 col-sm-12">
            <div class="card-header">
                <h3 class="card-title">Line chart</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="container" style="width: 80%;">
                    <canvas id="canvas2"></canvas>
                    <button type="button" class="btn btn-primary mt-2" id="download-pdf2">
                        Download PDF
                    </button>
                </div>
                <script>
                    var gradient = ctx.createLinearGradient(0, 0, 0, 300);
                    gradient.addColorStop(0, 'rgb(171,219,255)');
                    gradient.addColorStop(1, 'rgba(170, 219, 255,0.3)');

                    var chartdata = {
                        type: 'line',
                        data: {
                            labels: <?php echo json_encode($cats); ?>,
                            // labels: month,
                            datasets: [
                                {
                                    borderWidth: 3,
                                    label: 'posts count',
                                    backgroundColor: gradient,
                                    data: <?php echo json_encode($data); ?>
                                }
                            ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        stepSize: 1,
                                        beginAtZero: true,
                                    }
                                }]
                            },
                            elements: {
                                line: {
                                    tension: 0 // disables bezier curves
                                }
                            },
                        }
                    }
                    var ctx = document.getElementById('canvas2').getContext('2d');
                    new Chart(ctx, chartdata);

                    //add event listener to button
                    document.getElementById('download-pdf2').addEventListener("click", downloadPDF);

                    //donwload pdf from original canvas
                    function downloadPDF() {
                        var canvas = document.querySelector('#canvas2');
                        //creates image
                        var canvasImg = canvas.toDataURL("image/jpeg", 1.0);

                        //creates PDF from img
                        var doc = new jsPDF('landscape');
                        doc.setFontSize(20);
                        doc.text(15, 15, "Line Chart");
                        doc.addImage(canvasImg, 'JPEG', 10, 10, 280, 150);
                        doc.save('canvas.pdf');
                    }

                </script>
                <!-- /.card-body -->
            </div>
        </div>
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
