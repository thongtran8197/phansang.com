@extends('admin.master')
@section('content')
    <div class="card card-primary col-md-12">
        <div class="card-header">
            <h3 class="card-title">In QR</h3>
        </div>
        <div id="qr-wrap" style="display: inline-block; background-color: white; width: 220px; padding: 10px">
            <img src="data:image/png;base64, {!! base64_encode($qr) !!} ">
        </div>
        <div class="card-body">
            <button class="btn btn-success btn-sm">
                Download
            </button>
        </div>
    </div>
    <script src="https://superal.github.io/canvas2image/canvas2image.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script>
        document.querySelector('button').addEventListener('click', function () {
            html2canvas(document.querySelector('#qr-wrap'), {
                onrendered: function (canvas) {
                    return Canvas2Image.saveAsPNG(canvas);
                }
            });
        });
    </script>
@endsection
