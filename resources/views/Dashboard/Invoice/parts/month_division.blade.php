
    @for($i = 1; $i <= $month_count;$i++)
        <div class="form-group  col-md-2">الشهر رقم {{$i}}</div>
        <div class="form-group  col-md-4">
            <input type="number" name="installment_price_divided[]" required placeholder="مبلغ التقسيط" step="any"
                   min="0" class="form-control installment_divided_class " onchange="sum_division(this)">
        </div>
    @endfor
    <div class="form-group  col-md-12">
        الاجمالي : <span style="font-weight: 800;" id="total-price"></span>
    </div>
    <a href="javascript:void(this)" class="btn btn-danger" id="remove_division" onclick="remove_division(this)">عدم التقسيم يدوي </a>
<input type="hidden" name="total_sum_division_prices" value="0" id="total_sum_division_prices">
