<!-- pdf_template.blade.php -->
<style>
    table {
        /* border-collapse: collapse; */
        width: 100%;
    }

    td {
        /* border: 1px solid #ddd; */
        padding: 8px;
    }

    div {
        white-space: normal;
    }

    .question {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
    }
</style>

@php
@endphp
{{-- @dd($chapterQuestions); --}}

@php
    if ($mock_wise == 1) {
        $tmp = $globalQuestionNum; // Use global question number across chapters
    } else {
        $tmp = 1; // Reset local question number for each chapter
    }
    // if ($globalQuestionNum == 1) {
    //     $tmp = 1;
    // } else {
    //     $tem = $globalQuestionNum;
    // }
@endphp
@foreach ($chapterQuestions as $question)
    {{-- {{ 'Global ' . $tmp }} --}}
    <div class="question"
        style="
    @if ($tmp % 2 == 0) background-color: #f1eff1; @endif
    padding:8px 0px ;
    padding-left:20px;
    ">
        <p style="line-height: 20px;"><b><span>{{ 'Q' . $tmp }}</span><span
                    style="margin-left: 10px;margin-right: 10px;">
                    {{ $question->question }}</span></b>
        </p>
        @if ($db != 'Q')
            <p style="margin-left: 30px; @if (strtolower($question->answer) == strtolower('A')) font-weight: bold; @endif">
                (a)
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $question->opt_a }}</p>
            <p style="margin-left: 0px; @if (strtolower($question->answer) == strtolower('B')) font-weight: bold; @endif">
                (b) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $question->opt_b }} </p>
            @if ($question->opt_c != null)
                <p style="margin-left: 20px; @if (strtolower($question->answer) == strtolower('C')) font-weight: bold; @endif">
                    (c) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $question->opt_c }} </p>
            @endif
            @if ($question->opt_d != null)
                <p style="margin-left: 20px; @if (strtolower($question->answer) == strtolower('D')) font-weight: bold; @endif">
                    (d) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{ $question->opt_d }} </p>
            @endif
        @else
            <p style="margin-left: 10px;margin-right: 5px; "> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (a)
                {{ $question->opt_a }} </p>
            <p style="margin-left: 10px;margin-right: 5px; "> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (b)
                {{ $question->opt_b }} </p>
            @if ($question->opt_c != null)
                <p style="margin-left: 10px;margin-right: 5px; "> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (c)
                    {{ $question->opt_c }} </p>
            @endif
            @if ($question->opt_d != null)
                <p style="margin-left: 10px;margin-right: 5px; "> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (d)
                    {{ $question->opt_d }} </p>
            @endif
        @endif

    </div>
    @php
        if ($mock_wise == 1) {
            $tmp++;
        } else {
            $tmp++;
        }
    @endphp
@endforeach
@php
    // $globalQuestionNum += $tmp;
@endphp
