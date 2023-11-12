<x-layout>

    <section class="container space-y-8 mb-8">
        <h2 class="text-2xl text-slate-080 font-semibold text-center">Check Out</h2>
        <div class="grid grid-cols-3 gap-16">

            {{-- form  --}}
            <div class="col-span-2 ">
                <form action="/checkout" method="POST" name="checkout" class="space-y-8">
                    @csrf
                    <h6 class="text-2xl text-slate-800 font-semibold">Customer Info</h6>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <fieldset
                                class="border focus-within:border-green-500 trans  border-solid border-gray-400 p-1 rounded ">
                                <input value="{{ old('first_name') }}" class="w-full peer border-0 px-5 py-1 focus:ring-0 " type="text" name="first_name"
                                    id="">
                                   
                                <legend
                                    class="text-normal peer-focus:animate-bounce  trans text-slate-700 -focus:animate-bounce px-2 trans">
                                    First Name</legend>
                            </fieldset>
                            <x-error name="first_name"></x-error>
                        </div>
                        <div>
                            <fieldset
                                class="border focus-within:border-green-500 trans border-solid border-gray-400 p-1 rounded">
                                <input value="{{ old('last_name') }}" class="w-full peer border-0 px-5 py-1 focus:ring-0" type="text" name="last_name"
                                    id="">
                                   
                                <legend class="text-normal peer-focus:animate-bounce px-2 trans text-slate-700 ">Last
                                    Name</legend>
                            </fieldset>
                            <x-error name="last_name"></x-error>
                        </div>
                        <div class="col-span-2">
                            <fieldset
                                class="border focus-within:border-green-500 trans border-solid border-gray-400 p-1 rounded">
                                <input value="{{ old('email') }}" class="w-full peer border-0 px-5 py-1 focus:ring-0" type="email" name="email"
                                    id="">
                                <legend class="text-normal peer-focus:animate-bounce px-2 trans text-slate-700 ">Email
                                </legend>
                            </fieldset>
                            <x-error name="email"></x-error>

                        </div>
                        <div>
                            <fieldset
                                class="border focus-within:border-green-500 trans border-solid border-gray-400 p-1 rounded">
                                <textarea class="w-full border-0 px-5 py-1 focus:ring-0 peer" type="text" name="address1" id="">{{ old('address1') }}</textarea>
                                <legend class="text-normal peer-focus:animate-bounce px-2 trans text-slate-700 ">Address
                                    1</legend>
                            </fieldset>
                            <x-error name="address1"></x-error>

                        </div>
                        <div>
                            <fieldset
                                class="border focus-within:border-green-500 trans border-solid border-gray-400 p-1 rounded">
                                <textarea " class="w-full border-0 px-5 py-1 focus:ring-0 peer" type="text" name="address2" id="">{{ old('address2') }}</textarea>
                                <legend class="text-normal peer-focus:animate-bounce px-2 trans text-slate-700 ">
                                    Address 2</legend>
                            </fieldset>
                            <x-error name="address2"></x-error>

                        </div>
                        <div>
                            <fieldset
                                class="border focus-within:border-green-500 trans border-solid border-gray-400 p-1 rounded">
                                <input value="{{ old('phone') }}" class="w-full border-0 px-5 py-1 focus:ring-0 peer" type="number" name="phone"
                                    id="">
                                <legend class="text-normal peer-focus:animate-bounce px-2 trans text-slate-700 ">Phone
                                </legend>
                            </fieldset>
                            <x-error name="phone"></x-error>

                        </div>
                        <div>
                            <fieldset
                                class="border focus-within:border-green-500 trans border-solid border-gray-400 p-1 rounded">
                                <input value="{{ old('postal_code') }}" class="w-full border-0 px-5 py-1 focus:ring-0 peer" type="number" name="postal_code"
                                    id="">
                                <legend class="text-normal peer-focus:animate-bounce px-2 trans text-slate-700 "> postal_code
                                    Code</legend>
                            </fieldset>
                            <x-error name="postal_code"></x-error>

                        </div>
                    </div>

                    <hr class="w-full h-2 border-slate-400">
                    <div>
                        <h4 class="text-lg text-slate-900 font-semibold mb-3">Payment</h4>
                        <p class="text-normal font-semibold text-slate-900">Select Payment Method</p>
                        @foreach ($payments as $payment)
                            <div class="mt-1">
                                <input class="payment-check checked:bg-green-500 checked:outline-green-600 checked:ring-0" id="{{ $payment->id }}" type="radio" name="payment"
                                    value="{{ $payment->id }}" {{ $payment->id === 1 ? 'checked':'' }} />
                                    <x-error name="payment"></x-error>
                                <label class="ml-3 text-slate-900" for="#{{ $payment->id }}">{{ $payment->payment_type }}</label>
                            </div>
                        @endforeach
                            <div class="payment-form hidden">
                                <h4 class="text-normal font-semibold text-slate-900 mt-4">Add Card</h4>
                                <div class="grid grid-cols-4 mt-2">
                                    <div class="col-span-2">
                                        <label class="block" for="">Card Number</label>
                                        <input type="number" class="rounded">
                                    </div>
                                </div>
                            </div>
                           
                        <button type="submit" {{ count($cart_items) <= 0  ? 'disabled':'' }} class="disabled:opacity-60 px-6 py-2 mt-5 bg-green-500 rounded-xl checkout-btn text-white font-semibold tracking-wide">Make Order</button>
                    </div>
                </form>
            </div>

            {{-- cart --}}
            <div class="col-span-1 space-y-4">
                <div class="flex justify-between items-center">
                    <h6 class="text-2xl text-slate-800 font-semibold">In Your Cart</h6>
                    <form action="/home/cart" method="get">
                        @csrf
                        <button class="underline underline-offset-4 text-green-500">Edit</button>
                    </form>
                </div>
                <div class="space-y-1">

                    <div class="flex justify-between items-center">
                        <h6 class="text-normal text-slate-800 font-semibold">Subtotal</h6>
                        <p>${{ $cart_items->sum('total') }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <h6 class="text-normal text-slate-800 font-semibold">Shipping</h6>
                        <p>0</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <h6 class="text-normal text-slate-800 font-semibold">Taxes</h6>
                        <p>0</p>
                    </div>
                </div>
                <div class="flex justify-between items-center ">
                    <h6 class="text-normal text-slate-800 font-bold">Total</h6>
                    <p class="font-bold">{{ $cart_items->sum('total')}}</p>
                </div>

                <div class="py-5">
                    <p class="text-normal text-slate-800 font-bold tracking-wide">Arrives {{ now()->format('D,M d') }} -
                        {{ now()->subHour()->format('h:i A') }}</p>
                </div>

                {{-- //cart item  --}}
                <div class="space-y-5">
                    @foreach ($cart_items as $cart_item)
                    <div class="flex gap-4">
                        <img src="{{ $cart_item->product->photo }}" class="w-20 h-20 block rounded-lg object-fill" alt="">
                        <div class="space-y-1">
                            <h4 class="text-noraml text-slate-800 font-bold">{{ $cart_item->product->title }}</h4>
                            <p class="text-slate-700 font-normal">Rating : {{ $cart_item->product->avg_rating }}/5</p>
                            <p class="text-slate-700 font-normal">Quantity : {{ $quantity = $cart_item->quantity }} @ ${{ $price = $cart_item->product->price }} </p>
                            <p class="text-normal tex-slate-800 font-bold">{{ $price * $quantity }}</p>
                        </div>
                    </div>
                    @endforeach
                 
                </div>
            </div>
        </div>
    </section>

</x-layout>