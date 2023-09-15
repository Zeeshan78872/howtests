<!-- table_of_contents.blade.php -->
<style>
    /* Add CSS styling for the table of contents */
    .toc-item {
        display: block;
        margin-bottom: 0.5em;
    }

    .chapter-number {
        font-weight: bold;
        font-size: 12px;
        font-family: 'Courier New', Courier, monospace;
    }

    .chapter-name {
        font-size: 12px;
        color: #5050ff;
        font-family: 'Courier New', Courier, monospace;
    }

    .dashes {
        content: '-';
        margin: 0 0.5em;
        color: black;
        display: inline-block;
        letter-spacing: 4px;
    }

    .page-number {
        font-size: 12px;
    }
</style>
{{-- question index --}}
<h1 style="font-size: 24px;font-family:Arial;    font-style: italic; color:#000078">{{ $files->title }}</h1>
<div class="toc-item" id="index">
    <span class="chapter-number">Index</span>
    <span class="dashes"
        width="">............................................................................</span>
    <span class="page-number"> <a style="text-decoration: none; color: black; ">1</a></span>
</div>
{{-- @if ($db != 'AWE') --}}
@php
    $count = 1;
    $ContentCh = 3;
@endphp
@foreach ($categories as $chapterNumber => $category)
    @php
        
        $chapterGroupQuestions = $questionQuery
            ->where('category_id', $category->category_id)
            ->inRandomOrder()
            ->take($category->select_question)
            ->get()
            ->chunk(10);
    @endphp
    @foreach ($chapterGroupQuestions as $index => $chapterQuestions)
        <div class="toc-item">
            <span class="chapter-name"><a
                    href="#chapter_{{ $chapterNumber + 1 . ($index + 1) }}">{{ $count }}.Test
                </a></span>
            <span class="dashes"
                width="">.............................................................................</span>
            <span class="page-number"> <a href="#chapter_{{ $chapterNumber + 1 . ($index + 1) }}"
                    style="text-decoration: none; color: black; ">{{ $ContentCh }}</a></span>
        </div>
        @php
            $count++;
            $ContentCh += 2;
        @endphp
    @endforeach
@endforeach
{{-- @endif --}}

{{-- answer index --}}
{{-- @if ($db != 'Q')
    <div class="toc-item">
        <span class="chapter-number">Answer Keys</span>
        <span class="dashes" width=""></span>
        <span class="page-number"> <a style="text-decoration: none; color: black; "></a></span>
    </div>
    @foreach ($categories as $chapterNumber => $chapterQuestions)
        <div class="toc-item">
            <span class="chapter-number"><a
                    href="#answer_chapter_{{ $chapterNumber + 1 . ($index + 1) }}">{{ $chapterNumber + 1 . ($index + 1) }}.Test
                    {{ $chapterNumber + 1 . ($index + 1) }}</a></span>
            <span class="dashes"
                width="">.............................................................................</span>
            <span class="page-number"> <a href="#answer_chapter_{{ $chapterNumber + 1 . ($index + 1) }}"
                    style="text-decoration: none; color: black; ">{{ $chapterPages[$chapterNumber] }}</a></span>
        </div>
    @endforeach
@endif --}}
