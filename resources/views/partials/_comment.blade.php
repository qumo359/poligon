<div class="single-comment justify-content-between  ">

    <div class="user   col-12">
        <div class="thumb">
            <img src="/storage/test/commentimage.png" alt="User Image">
        </div>
        <div class="desc">
            <p class="comment">
                {{ $comment->body }}
            </p>
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    <h5>
                        <a href="">{{ $comment?->user?->name }}</a>
                    </h5>
                    <p class="date">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
                <div class="reply-btn">
                    <a href="#" class="btn-reply text-uppercase reply-button" data-comment-id="{{ $comment->id }}">ответить</a>
                </div>
            </div>
        </div>
    </div>
    <div class="reply-form col-12" id="reply-form-{{ $comment->id }}" style="display: none;  clear: both; width: 100%;">
        <form method="POST" action="{{ route('blog.posts.comments.store', $item) }}">
            @csrf
            <div class="form-group">
                <textarea class="form-control w-100" name="comment" cols="30" rows="3"
                          placeholder="Написать ответ"></textarea>
                <input type="hidden" name="parent_id"
                       value="{{ $comment->id }}"> {{-- Передаем ID родительского комментария --}}
            </div>
            <div class="form-group">
                <button type="submit" class=" button  button-contactForm btn_1 boxed-btn btn-sm">Отправить ответ
                </button>
            </div>
        </form>
    </div>

    <div class="comment-list"> {{-- Контейнер для ответов --}}
        @foreach($comment->replies as $reply)
            @include('partials._comment', ['comment' => $reply]) {{-- Рекурсивный вызов для дочерних комментариев --}}
        @endforeach
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const replyButtons = document.querySelectorAll('.reply-button');

        replyButtons.forEach(button => {
            button.addEventListener('click', function (event) {

                event.preventDefault();
                const commentId = this.dataset.commentId;


                console.log(commentId)
                const replyForm = document.getElementById('reply-form-' + commentId);

                    replyForm.style.display = 'block'


            });
        });
    });
</script>
