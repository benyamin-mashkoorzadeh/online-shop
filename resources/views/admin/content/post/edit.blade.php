@extends('admin.layouts.master')

@section('head-tag')
    <title>پست ها</title>
@endsection

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item font-size-12"><a href="#">خانه</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">بخش محتوی</a></li>
            <li class="breadcrumb-item font-size-12"><a href="#">پست ها</a></li>
            <li class="breadcrumb-item font-size-12 active"> ویرایش پست</li>
        </ol>
    </nav>

    <section class="row">
        <section class="col-12">
            <section class="main-body-container">
                <section class="main-body-container-header">
                    <h5>ویرایش پست</h5>
                </section>
                <section
                    class="body-content d-flex justify-content-between align-items-center mt-4 mb-3 border-bottom pb-2">
                    <a href="{{ route('admin.content.post.index') }}" class="btn btn-info btn-sm">بازگشت</a>
                </section>

                <section>
                    <form action="{{ route('admin.content.post.update', $post->id) }}" method="post"
                          enctype="multipart/form-data" id="form">
                        @csrf
                        {{ method_field('put') }}
                        <section class="row">
                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="title">
                                        عنوان پست
                                        @error('title')
                                        <span class="alert_required text-danger p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                        @enderror
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="title" name="title"
                                           value="{{ old('title', $post->title) }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="category_id">
                                        انتخاب دسته
                                        @error('category_id')
                                        <span class="alert_required text-danger p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                        </span>
                                        @enderror
                                    </label>
                                    <select name="category_id" id="category_id" class="form-control form-control-sm">
                                        <option value="">دسته را انتخاب کنید</option>
                                        @foreach($postCategories as $postCategory)
                                            <option
                                                value="{{ $postCategory->id }}" @if(old('category_id', $post->category_id) == $postCategory->id) selected @endif>{{ $postCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="image">تصویر
                                        @error('image')
                                        <span class="alert_required text-danger p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                        @enderror
                                    </label>
                                    <input type="file" class="form-control form-control-sm" id="image" name="image">
                                </div>
                                <section class="row">
                                    @php
                                        $number = 1;
                                    @endphp
                                    @foreach ($post->image['indexArray'] as $key => $value)

                                        <section class="col-md-{{ 6 / $number }}">
                                            <div class="form-check">
                                                <input type="radio" name="currentImage" class="form-check-input" value="{{ $key }}"
                                                       id="{{ $number }}" @if($post->image['currentImage'] == $key) checked @endif>
                                                <label for="{{ $number }}" class="form-check-label mx-2">
                                                    <img src="{{ asset($value) }}" class="w-100" alt="">
                                                </label>
                                            </div>
                                        </section>

                                        @php
                                            $number++;
                                        @endphp
                                    @endforeach
                                </section>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">وضعیت</label>
                                    <select name="status" id="" class="form-control form-control-sm">
                                        <option value="0"
                                                @if(old('status', $post->status) == 0) selected @endif>غیر فعال
                                        </option>
                                        <option value="1"
                                                @if(old('status', $post->status) == 1) selected @endif>فعال
                                        </option>
                                    </select>
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="commentable">امکان درج کامنت</label>
                                    <select name="commentable" id="commentable" class="form-control form-control-sm">
                                        <option value="0" @if(old('commentable', $post->commentable) == 0) selected @endif>غیر فعال</option>
                                        <option value="1" @if(old('commentable', $post->commentable) == 1) selected @endif>فعال</option>
                                    </select>
                                </div>
                            </section>

                            <section class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="">تاریخ انتشار</label>
                                    <input type="text" name="published_at" id="published_at"
                                           class="form-control form-control-sm d-none">
                                    <input type="text" id="published_at_view" class="form-control form-control-sm" value="{{ old('published_at', $post->published_at) }}">
                                </div>
                            </section>

                            <section class="col-12 col-md-12">
                                <div class="form-group">
                                    <label for="tags">تگ ها
                                        @error('tags')
                                        <span class="alert_required text-danger p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                        @enderror
                                    </label>
                                    <input type="hidden" class="form-control form-control-sm" id="tags" name="tags"
                                           value="{{ old('tags', $post->tags) }}">
                                    <select class="select2 form-control form-control-sm" id="select_tags"
                                            multiple></select></div>
                            </section>

                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="description">خلاصه پست
                                        @error('summary')
                                        <span class="alert_required text-danger p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                        @enderror
                                    </label>
                                    <textarea class="form-control form-control-sm" id="summary" name="summary">
                                        {{ old('summary', $post->summary) }}
                                    </textarea>
                                </div>
                            </section>

                            <section class="col-12 my-2">
                                <div class="form-group">
                                    <label for="description">متن پست
                                        @error('body')
                                        <span class="alert_required text-danger p-1" role="alert">
                                    <strong>
                                        {{ $message }}
                                    </strong>
                                </span>
                                        @enderror
                                    </label>
                                    <textarea class="form-control form-control-sm" id="body" name="body">
                                        {{ old('body', $post->body) }}
                                    </textarea>
                                </div>
                            </section>
                            <section class="col-12">
                                <button class="btn btn-primary btn-sm">ثبت</button>
                            </section>
                        </section>
                    </form>
                </section>
            </section>
        </section>
    </section>

@endsection
@section('script')
    <script src="{{ asset('admin-assets/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('summary');
        CKEDITOR.replace('body');
    </script>
    <script>
        $(document).ready(function () {
            let tags_input = $('#tags')
            let select_tags = $('#select_tags')
            let default_tags = tags_input.val();
            let default_data = null

            if (tags_input.val() !== null && tags_input.val(length > 0)) {
                default_data = default_tags.split(',')
            }

            select_tags.select2({
                placeholder: 'لطفاْ تگ های خود را وارد نمایید',
                tags: true,
                data: default_data
            })

            select_tags.children('option').attr('selected', true).trigger('change')

            $('#form').submit(function (event) {
                if (select_tags.val() != null && select_tags.val().length > 0) {
                    let selectedSource = select_tags.val().join(',')
                    tags_input.val(selectedSource)
                }
            })
        })
    </script>
@endsection
