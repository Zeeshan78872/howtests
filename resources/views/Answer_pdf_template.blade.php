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
        $questionNum = $aglobalQuestionNum; // Use global question number across chapters
    } else {
        $questionNum = 0; // Reset local question number for each chapter
    }
@endphp
@foreach ($chapterQuestions as $question)
    <div class="question"
        style="
    @if ($questionNum % 2 == 0) background-color: #f1eff1; @endif
    padding:8px 0px ;
    padding-left:20px;
    padding-right:20px;
    ">
        <p style="line-height: 20px;"><b><span
                    style="margin-right: 5px;margin-left: 5px;">{{ 'Q' . ($questionNum + 1) }}</span><span>
                    {{ $question->question }}</span></b>
        </p>

        <p style="margin-left: 5px;margin-right: 5px; @if (strtolower($question->answer) == strtolower('A')) font-weight: bold; @endif">

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(a) {{ $question->opt_a }} </p>
        <p style="margin-left: 5px;margin-right: 5px; @if (strtolower($question->answer) == strtolower('B')) font-weight: bold; @endif">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(b) {{ $question->opt_b }} </p>
        @if ($question->opt_c != null)
            <p style="margin-left: 5px;margin-right: 5px; @if (strtolower($question->answer) == strtolower('C')) font-weight: bold; @endif">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(c) {{ $question->opt_c }} </p>
        @endif
        @if ($question->opt_d != null)
            <p style="margin-left: 5px;margin-right: 5px; @if (strtolower($question->answer) == strtolower('D')) font-weight: bold; @endif">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(d) {{ $question->opt_d }} </p>
        @endif

        @if (isset($db) && ($db = 'AWE'))
            <p style="margin-left: 5px;margin-right: 5px;"><b>Explanation:</b> {{ $question->explanation }}</p>
        @endif

    </div>
    @php
        if ($mock_wise == 1) {
            $questionNum++;
            $aglobalQuestionNum += $questionNum;
        } else {
            $questionNum++;
        }
    @endphp
@endforeach
