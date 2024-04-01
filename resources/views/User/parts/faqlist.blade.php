@php
  $faqslists = \App\Models\Faq::latest()
      ->where('status', '1')
      ->where('link_code', Request::path())
      ->orderBy('lineup')
      ->get();
@endphp
<div class="accordion" id="faqs_{{ Request::path() }}">
    @foreach ($faqslists as $key => $val)
      <div class="card">
          <div class="card-header p-2" id="faqcardtoggle_{{ $val['id'] }}">
              <h5 class="mb-0">
                  <button style="color: #D8D8D8;" class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqcollapsetoggle_{{ $val['id'] }}" aria-expanded="{{ $key=='0'?'true':'false' }}" aria-controls="faqcollapsetoggle_{{ $val['id'] }}">
                    Q: {{ $val['question'] }}
                  </button>
                </h5>
          </div>

          <div id="faqcollapsetoggle_{{ $val['id'] }}" class="collapse {{ $key=='0'?'show':'' }}" aria-labelledby="faqcardtoggle_{{ $val['id'] }}" data-parent="#faqs_{{ Request::path() }}">
              <div class="card-body">
                  <b>Answer:</b> {{ $val['answer'] }}
              </div>
          </div>
      </div>
    @endforeach
</div>
