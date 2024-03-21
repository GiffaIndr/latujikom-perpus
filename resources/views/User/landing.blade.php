@extends('Layout.cdn')
@extends('Layout.navbar')
@section('content2')

    <body>
        <div class="container mt-4 justify-content-center" style="display: flex; gap: 20px;">
            <div class="d-flex  gap-3 " style=" flex-warp: wrapper;">
                @if (Auth::user()->role == 'user')
                    @foreach ($book as $books)
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset('assets/img/' . $books->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="font-weight-[700]">{{ $books->name }}</h4>
                                <div class="d-flex justify-content-center gap-3">
                                    <div>
                                        <a class="btn" href="{{ route('borrow.book', ['id' => $books->id]) }}" style="padding: 10px; color: blue;">borrow</a>
                                    </div>
                                    <div>
                                        <a class="btn" style="padding: 10px; color: green;">collection</a>
                                    </div>
                                    <div>
                                        <a class="btn" style="padding: 10px; color: cadetblue;">review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if(Auth::user()->role == 'admin')
                <div class="container">
                    <a class="btn btn-primary" href='/dashboard/book'>go to admin page</a>
                </div>
                @endif
                @if(Auth::user()->role == 'staff')
                <div class="container">
                    <a class="btn btn-primary" href='/dashboard/book'>go to staff page</a>
                </div>
                @endif
            </div>
        </div>
    </body>

@endsection
