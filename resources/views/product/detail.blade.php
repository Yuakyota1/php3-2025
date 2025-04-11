<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<mecta harset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <head>
        @include('layout.head')
    </head>


    <style>
        .carousel-item img {
            max-height: 400px;
            object-fit: contain;
        }

        .product-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2,
        h4,
        h5 {
            font-size: 1.8rem;
        }

        p,
        label,
        select,
        input {
            font-size: 1.2rem;
        }

        #productPrice {
            font-size: 1.5rem;
        }

        /* Styling for comment form */
        .comment-box {
            border-radius: 10px;
            background: #f8f9fa;
            padding: 15px;
            margin-left: 280px;
            margin-right: 100px;
        }

        .comment-box strong {
            color: #007bff;
        }

        .comment-box img {
            border-radius: 5px;
            margin-top: 10px;
        }

        .comment-form {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-left: 280px;
            margin-right: 100px;
        }

        .comment-form textarea {
            resize: none;
            border-radius: 5px;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 1.5rem;
            cursor: pointer;
            color: gray;
        }

        .rating input:checked~label {
            color: gold;
        }
    </style>

    <body>
        <!-- Modal thông báo -->
        <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalLabel">Thông báo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="notificationMessage">Nội dung thông báo.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        @include('layout.header')

        <div class="container py-4">
            <h2>Chi tiết sản phẩm</h2>
            <div class="row">
                <div class="col-md-6">
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @php $images = json_decode($product->images, true) ?? []; @endphp
                            @if (!empty($images))
                            @foreach ($images as $key => $image)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 img-fluid rounded" alt="{{ $product->product_name }}">
                            </div>
                            @endforeach
                            @endif
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

                <div class="col-md-6 product-info">
                    <h4>{{ $product->product_name }}</h4>
                    <p><strong>Mô tả:</strong> {{ $product->description }}</p>
                    <p><strong>ID sản phẩm:</strong> {{ $product->id }}</p>
                    <p><strong>Danh mục con:</strong> {{ $product->subCategory->subcategory_name ?? 'Không xác định' }}</p>

                    <h5 class="mt-4">Chọn kích thước & màu sắc</h5>
                    <div class="mb-3">
                        <label for="sizeSelect" class="form-label">Chọn kích thước:</label>
                        <select id="sizeSelect" class="form-control">
                            <option value="">-- Chọn kích thước --</option>
                            @if (!empty($product->sizeColors) && is_iterable($product->sizeColors))
                            @foreach ($product->sizeColors->unique('idSize') as $sizeColor)
                            <option value="{{ $sizeColor->idSize }}">{{ $sizeColor->size->size_name ?? 'Không xác định' }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="colorSelect" class="form-label">Chọn màu sắc:</label>
                        <select id="colorSelect" class="form-control" disabled>
                            <option value="">-- Chọn màu --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantityInput" class="form-label">Số lượng:</label>
                        <input type="number" id="quantityInput" class="form-control" value="1" min="1">
                    </div>

                    <p class="mt-2"><strong>Giá:</strong> <span id="productPrice" class="text-danger fs-5">0 VND</span></p>
                    <button id="addToCartBtn" class="btn btn-primary mt-3">Thêm vào giỏ hàng</button>
                    <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Quay lại</a>
                </div>
            </div>
        </div>

        @if (!empty($product->comments) && is_iterable($product->comments))
    @foreach($product->comments as $comment)
    <div class="comment-box border p-3 my-2">
        <strong>{{ $comment->user->name ?? 'Khách' }}</strong>
        @if(isset($comment->rating))
        <div class="rating-display">
            @for ($i = 1; $i <= 5; $i++)
                <span class="{{ $i <= $comment->rating ? 'text-warning' : 'text-muted' }}">★</span>
            @endfor
        </div>
        @endif
        <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
        <p>{{ $comment->content }}</p>

        @if ($comment->image)
        <img src="{{ asset('storage/' . $comment->image) }}" width="100">
        @endif

        @if (Auth::id() === $comment->user_id)
        <div class="comment-actions">
            <button class="btn btn-warning btn-sm toggle-edit-form" data-comment-id="{{ $comment->id }}">Sửa</button>
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
            </form>

            <div id="edit-form-{{ $comment->id }}" class="mt-2 d-none">
                <form class="edit-comment-form" data-comment-id="{{ $comment->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-2">
                        <textarea name="content" class="form-control" rows="3" required>{{ $comment->content }}</textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Thay đổi ảnh (tùy chọn):</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Cập nhật</button>
                    <button type="button" class="btn btn-secondary btn-sm toggle-edit-form" data-target="#edit-form-{{ $comment->id }}">Hủy</button>
                </form>
            </div>
        </div>
        @endif

        {{-- Hiển thị phản hồi --}}
        @foreach($comment->replies->where('parent_reply_id', null) as $reply)
        <div class="reply-box border p-2 my-2 ms-4 bg-light" id="reply-{{ $reply->id }}">
            <p>
                <strong>{{ $reply->user->name ?? 'Khách' }}</strong> ➜ 
                <strong>{{ $comment->user->name ?? 'Khách' }}</strong>: 
                {{ $reply->content }}
            </p>

            @if ($reply->image)
            <img src="{{ asset('storage/' . $reply->image) }}" width="100">
            @endif

            @if (Auth::id() === $reply->user_id)
            <form action="{{ route('commentReplies.destroy', $reply->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
            </form>
            @endif

            <!-- Form trả lời phản hồi (ẩn) -->
            @if (Auth::check())
            <button class="btn btn-sm btn-link text-primary toggle-reply-form" data-target="#reply-form-{{ $reply->id }}">Reply</button>

            <div id="reply-form-{{ $reply->id }}" class="mt-2 d-none">
                <form class="create-reply-form" data-parent-id="{{ $reply->id }}" data-comment-id="{{ $comment->id }}">
                    @csrf
                    <input type="hidden" name="parent_reply_id" value="{{ $reply->id }}">
                    <textarea name="content" class="form-control mb-1" rows="2" placeholder="Trả lời phản hồi..." required></textarea>
                    <input type="file" name="image" class="form-control mb-1">
                    <button type="submit" class="btn btn-sm btn-primary">Gửi phản hồi</button>
                </form>
            </div>
            @endif

            {{-- Hiển thị phản hồi con --}}
            @foreach($reply->children as $childReply)
            <div class="reply-box ms-4 bg-white border p-2 mt-2" id="reply-{{ $childReply->id }}">
                <p>
                    <strong>{{ $childReply->user->name ?? 'Khách' }}</strong> ➜
                    <strong>{{ $reply->user->name ?? 'Khách' }}</strong>:
                    {{ $childReply->content }}
                </p>
                
                @if ($childReply->image)
                <img src="{{ asset('storage/' . $childReply->image) }}" width="100">
                @endif

                @foreach($childReply->children as $grandChildReply)
                <div class="reply-box ms-4 bg-white border p-2 mt-2" id="reply-{{ $grandChildReply->id }}">
                    <p>
                        <strong>{{ $grandChildReply->user->name ?? 'Khách' }}</strong> ➜
                        <strong>{{ $childReply->user->name ?? 'Khách' }}</strong>:
                        {{ $grandChildReply->content }}
                    </p>
                    @if ($grandChildReply->image)
                    <img src="{{ asset('storage/' . $grandChildReply->image) }}" width="100">
                    @endif
                </div>
                @endforeach

                @if (Auth::check())
                <button class="btn btn-sm btn-link text-primary toggle-reply-form" data-target="#reply-form-{{ $childReply->id }}">Reply</button>

                <div id="reply-form-{{ $childReply->id }}" class="mt-2 d-none">
                    <form class="create-reply-form" data-parent-id="{{ $childReply->id }}" data-comment-id="{{ $comment->id }}">
                        @csrf
                        <input type="hidden" name="parent_reply_id" value="{{ $childReply->id }}">
                        <textarea name="content" class="form-control mb-1" rows="2" placeholder="Trả lời phản hồi..." required></textarea>
                        <input type="file" name="image" class="form-control mb-1">
                        <button type="submit" class="btn btn-sm btn-primary">Gửi phản hồi</button>
                    </form>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @endforeach

        {{-- Form phản hồi bình luận gốc --}}
        @if (Auth::check())
        <div class="reply-form mt-3">
            <form class="create-reply-form" data-comment-id="{{ $comment->id }}">
                @csrf
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <div class="mb-3">
                    <label class="form-label">Phản hồi:</label>
                    <textarea name="content" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tải ảnh lên (tùy chọn):</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
            </form>
        </div>
        @endif
    </div>
    @endforeach
@endif

        @include('layout.footer')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle form trả lời
    document.querySelectorAll('.toggle-reply-form').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const form = document.querySelector(targetId);
            if (form) {
                form.classList.toggle('d-none');
            } else {
                console.error('Form not found for target:', targetId);
            }
        });
    });

    // Toggle form sửa comment
    document.querySelectorAll('.toggle-edit-form').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target') || `#edit-form-${this.getAttribute('data-comment-id')}`;
            const form = document.querySelector(targetId);
            if (form) {
                form.classList.toggle('d-none');
            }
        });
    });

    // Xử lý tạo reply bằng Ajax
    document.querySelectorAll('.create-reply-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const commentId = this.getAttribute('data-comment-id');
            const parentId = this.getAttribute('data-parent-id');
            const formData = new FormData(this);

            fetch("{{ route('commentReplies.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Thêm reply mới vào giao diện
                        const reply = data.reply;
                        const replyHtml = `
                            <div class="reply-box border p-2 my-2 ms-4 bg-light" id="reply-${reply.id}">
                                <p>
                                    <strong>${reply.user.name ?? 'Khách'}</strong> ➜ 
                                    <strong>${reply.comment_id ? document.querySelector(`#edit-form-${commentId}`).closest('.comment-box').querySelector('strong').textContent : reply.parent_reply.user.name ?? 'Khách'}</strong>: 
                                    ${reply.content}
                                </p>
                                ${reply.image ? `<img src="/storage/${reply.image}" width="100">` : ''}
                                ${reply.user_id === {{ Auth::id() }} ? `
                                    <form action="{{ route('commentReplies.destroy', '') }}/${reply.id}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                ` : ''}
                                @if (Auth::check())
                                <button class="btn btn-sm btn-link text-primary toggle-reply-form" data-target="#reply-form-${reply.id}">Reply</button>
                                <div id="reply-form-${reply.id}" class="mt-2 d-none">
                                    <form class="create-reply-form" data-parent-id="${reply.id}" data-comment-id="${commentId}">
                                        @csrf
                                        <input type="hidden" name="parent_reply_id" value="${reply.id}">
                                        <textarea name="content" class="form-control mb-1" rows="2" placeholder="Trả lời phản hồi..." required></textarea>
                                        <input type="file" name="image" class="form-control mb-1">
                                        <button type="submit" class="btn btn-sm btn-primary">Gửi phản hồi</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        `;

                        if (parentId) {
                            const parentReply = document.querySelector(`#reply-${parentId}`);
                            parentReply.insertAdjacentHTML('beforeend', replyHtml);
                        } else {
                            const repliesContainer = document.querySelector(`#edit-form-${commentId}`).closest('.comment-box').querySelector('.reply-form');
                            repliesContainer.insertAdjacentHTML('beforebegin', replyHtml);
                        }

                        // Reset và ẩn form
                        this.reset();
                        if (parentId) {
                            document.querySelector(`#reply-form-${parentId}`).classList.add('d-none');
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Đã có lỗi xảy ra khi gửi phản hồi.'
                });
            });
        });
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Toggle form sửa
    document.querySelectorAll('.toggle-edit-form').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target') || `#edit-form-${this.getAttribute('data-comment-id')}`;
            const form = document.querySelector(targetId);
            form.classList.toggle('d-none');
        });
    });

    // Xử lý submit form bằng Ajax
    document.querySelectorAll('.edit-comment-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const commentId = this.getAttribute('data-comment-id');
            const formData = new FormData(this);

            fetch(`/comments/${commentId}`, {
                method: 'POST', // Laravel sẽ tự xử lý PUT qua _method
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Cập nhật nội dung comment trên giao diện
                        const commentBox = document.querySelector(`#edit-form-${commentId}`).closest('.comment-box');
                        commentBox.querySelector('p').textContent = data.comment.content;
                        if (data.comment.image) {
                            const img = commentBox.querySelector('img');
                            if (img) {
                                img.src = `/storage/${data.comment.image}`;
                            } else {
                                commentBox.insertAdjacentHTML('beforeend', `<img src="/storage/${data.comment.image}" width="100">`);
                            }
                        }
                        // Ẩn form sau khi cập nhật
                        document.querySelector(`#edit-form-${commentId}`).classList.add('d-none');
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Đã có lỗi xảy ra khi cập nhật bình luận.'
                });
            });
        });
    });
});
</script>
<!-- Trong thẻ <head> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Toggle form sửa comment
    document.querySelectorAll('.toggle-edit-form').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const form = document.querySelector(targetId);
            form.classList.toggle('d-none');
        });
    });

    // Toggle form trả lời
    document.querySelectorAll('.toggle-reply-form').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const form = document.querySelector(targetId);
            form.classList.toggle('d-none');
        });
    });
});
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.toggle-reply-form').forEach(btn => {
            btn.addEventListener('click', function() {
                const target = document.querySelector(this.dataset.target);
                if (target) {
                    target.classList.toggle('d-none');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        let allData = @json($product -> sizeColors -> toArray());
        let basePrice = 0;

        $('#sizeSelect').change(function() {
            let selectedSize = $(this).val();
            let colors = allData.filter(item => item.idSize == selectedSize);

            $('#colorSelect').html('<option value="">-- Chọn màu --</option>');
            colors.forEach(item => {
                $('#colorSelect').append(`<option value="${item.color}" data-price="${item.price}">${item.color}</option>`);
            });

            $('#colorSelect').prop('disabled', colors.length === 0);
            $('#productPrice').text('0 VND');
            basePrice = 0;
        });

        $('#colorSelect').change(function() {
            basePrice = $(this).find(':selected').data('price') || 0;
            updateTotalPrice();
        });

        $('#quantityInput').on('input', function() {
            updateTotalPrice();
        });

        function updateTotalPrice() {
            let quantity = parseInt($('#quantityInput').val()) || 1;
            let totalPrice = basePrice * quantity;
            $('#productPrice').text(new Intl.NumberFormat('vi-VN').format(totalPrice) + ' VND');
        }

        function showPopup(message) {
            $('#notificationMessage').text(message);
            $('#notificationModal').modal('show');
        }

        $('#addToCartBtn').click(function() {
            let size = $('#sizeSelect').val();
            let color = $('#colorSelect').val();
            let quantity = $('#quantityInput').val();
            let productId = "{{ $product->id }}";
            let name = "{{ $product->product_name }}";
            let image = "{{ asset('storage/' . (isset($images[0]) ? $images[0] : 'default.jpg')) }}";

            if (!size || !color) {
                showPopup('Vui lòng chọn kích thước và màu sắc!');
                return;
            }

            $.ajax({
                url: "{{ route('cart.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    size: size,
                    color: color,
                    name: name,
                    quantity: quantity,
                    price: basePrice,
                    total_price: basePrice * quantity,
                    image: image
                },
                success: function(response) {
                    showPopup(response.message); // Hiển thị popup
                    setTimeout(function() {
                        window.location.href = "{{ route('cart.index') }}"; // Chuyển trang sau 2 giây
                    }, 2000);

                },
                error: function() {
                    showPopup('Có lỗi xảy ra!');
                }
            });
        });


        @if(session('success'))
        showPopup("{{ session('success') }}");
        @endif

        @if(session('error'))
        showPopup("{{ session('error') }}");
        @endif
    });
</script>

</body>

</html>