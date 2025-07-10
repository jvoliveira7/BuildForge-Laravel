@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-700 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-orange-500 mb-8">🛒 Seu Carrinho</h1>

        <div id="carrinho-container">
            @include('partials.carrinho')
        </div>
    </div>
</div>

{{-- jQuery (ou use Alpine/axios se preferir) --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.btn-remover-item', function (e) {
    e.preventDefault();
    
    let url = $(this).data('url');
    let linha = $(this).closest('.item-carrinho');

    linha.fadeOut(300, function () {
        $.post(url, {
            _token: '{{ csrf_token() }}'
        }, function (res) {
            $('#carrinho-container').html(res.html);
        });
    });
});
</script>
@endsection
