@if($invoice->invoice_type ==\App\Enums\InvoiceTypeEnum::INSURANCE->value)
    <h3>وصلات الامانة</h3>
    @foreach($invoice->papers as $paper)
        <div class="d-flex align-items-center justify-content-between mb-2  ">
            <span class="font-weight-bold ">{{($invoice->customer_id == $paper->customer_id)? 'العميل' : 'الضامن'}}</span>
            <span class="font-weight-bold ">{{$paper->customer->name}}</span>
            <span class="font-weight-bold mr-2">{{$paper->paper_amount}} ( {{$paper->paper_amount_txt}} )</span>
            <a class="btn btn-info font-weight-bold"
               target="_blank"
               href="{{route('invoice.print',$paper->id)}}">@lang('lang.print')
                <i class="fas fa-print"></i></a>
        </div>
    @endforeach
@endif


@if($invoice->invoice_type ==\App\Enums\InvoiceTypeEnum::INVOICE->value)
    <h3>وصلات الامانة من فاتورة اخرى رقم :  <span class="text-primary font-weight-bold">{{$invoice->invoice_id}}</span></h3>
    @foreach($invoice->invoice->papers as $paper)
        <div class="d-flex align-items-center justify-content-between mb-2  ">
            <span class="font-weight-bold ">{{($invoice->customer_id == $paper->customer_id)? 'العميل' : 'الضامن'}}</span>
            <span class="font-weight-bold ">{{$paper->customer->name}}</span>
            <span class="font-weight-bold mr-2">{{$paper->paper_amount}} ( {{$paper->paper_amount_txt}} )</span>
            <a class="btn btn-info font-weight-bold"
               target="_blank"
               href="{{route('invoice.print',$paper->id)}}">@lang('lang.print')
                <i class="fas fa-print"></i></a>
        </div>
    @endforeach
@endif

@if($invoice->invoice_type ==\App\Enums\InvoiceTypeEnum::ATTORNEY->value)
    <div class="d-flex align-items-center justify-content-between mb-2">
        <span class="font-weight-bold mr-2">@lang('lang.invoice_type') </span>
        <span class="font-weight-bold ">@lang('lang.attorney')</span>
    </div>
@endif
