@include('shared.header')

<body>
    <main class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            <a href="/lottery" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Diversition</span>
            </a>
        </header>

        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <p class="h2 fw-bold mb-3">ผลการออกรางวัลล็อตเตอรี่ Diversition</p>
                <article class="mb-3">
                    <div class="row gx-3 mb-3">
                        <div class="col-3">
                            <div class="card text-center" style="width: 18rem;">
                                <div class="card-body">
                                    <p class="card-title h1" style="color:#F2812D">{{ session()->get('display')['top'] ?? '' }}</p>
                                    <p class="card-text">รางวัลที่ 1</p>
                                    <p class="card-text">จำนวน 1 รางวัล</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card text-center" style="width: 18rem;">
                                <div class="card-body">
                                    <p class="card-title h1">{{ session()->get('display')['neighbor'] ?? '' }}</p>
                                    <p class="card-text">รางวัลเลขข้างเคียงรางวัลที่ 1</p>
                                    <p class="card-text">จำนวน 2 รางวัล</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card text-center" style="width: 18rem;">
                                <div class="card-body">
                                    <p class="card-title h1">{{ session()->get('display')['second'] ?? '' }}</p>
                                    <p class="card-text">รางวัลที่ 2</p>
                                    <p class="card-text">จำนวน 3 รางวัล</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card text-center" style="width: 18rem;">
                                <div class="card-body">
                                    <p class="card-title h1">{{ session()->get('display')['lastTwoDigit'] ?? '' }}</p>
                                    <p class="card-text">เลขท้าย 2 ตัว</p>
                                    <p class="card-text">จำนวน 10 รางวัล</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-12">
                            <form action="/lottery/draw" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">สุ่มรางวัล</button>
                            </form>
                        </div>
                    </div>
                </article>
                <p class="h2 fw-bold mb-3">ตรวจรางวัลล็อตเตอรี่ Diversition</p>
                <article class="mb-3">
                    <form action="/lottery/find" method="post">
                        <div class="row g-3">
                            <div class="col-10">
                                <input type="number" name="lotNum" class="form-control">
                            </div>
                            <div class="col-2">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">ตรวจรางวัล</button>
                            </div>
                            @if(session()->has('congrat'))
                            <div class="col-12">
                                <div class="alert alert-success" role="alert">
                                    {{ session()->get('congrat') }}
                                </div>
                            </div>
                            @endif
                            @if(session()->has('failed'))
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    {{ session()->get('failed') }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </article>
            </div>
        </div>
    </main>
</body>

</html>