@extends('layouts.app')
@section('content')


<div class="container">
    <div class="upper-section">
        <h2>Menu</h2>
        <a href="{{ url('cart/index') }}" title="View Cart">
            <button class="btn btn-primary btn-sm" style="margin-left: 10px; margin-bottom: 10px; height: 28px; width: 100px;"><i aria-hidden="true"></i>View Cart</button></a>
        @if (session('success'))
        <div>{{ session('success') }}</div>
        @endif
        <table class="table">
            <tbody>
                @foreach ($product as $item)
                <div className="card">
                    <form action="{{ route('add.to.cart', $item->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <button type="submit">
                            <img src="{{ Storage::url($item->image) }}" alt="image" width="150px">
                            <h5>{{ $item -> name }}</h5>
                        </button>
                    </form>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>