
@if($type === 'add-product')
    <span>New Product was added by</span>
    <span>{{ $recipent }}</span>
@endif

@if($type === 'update-product')
    <span> Product was updated by</span>
    <span>{{ $recipent }}</span>
@endif


@if($type === 'delete-product')
    <span> Product was deleted by</span>
    <span>{{ $recipent }}</span>
@endif

@if($type === 'change-order-status')
    <span>Your Order status was changed by</span>
    <span>{{ $recipent }}</span>
@endif

@if($type === 'order-success')
    <span>Your Order  was successed by</span>
    <span>{{ $recipent }}</span>
@endif

@if($type === 'order-create')
<span>New order was recived by</span>
<span>{{ $recipent }}</span>
@endif

@if($type === 'out-stock')
<span>check product!some product is out of stock</span>
@endif

@if($type === 'write-review')
<span>New review was written by</span>
<span>{{ $recipent }}</span>
@endif

@if($type === 'subscribe')
<span>{{ $recipent }} was subscribed</span>
@endif

@if($type === 'recive-coupon')
<span>You get a discount coupon.check your mail</span>

@endif