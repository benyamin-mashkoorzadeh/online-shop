<?php

namespace App\Models\Market;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function copan()
    {
        return $this->belongsTo(Copan::class);
    }

    public function commonDiscount()
    {
        return $this->belongsTo(CommonDiscount::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getPaymentStatusValueAttribute()
    {
        switch ($this->payment_status) {
            case 0:
                $result = 'پرداخت نشده';
                break;

            case 1:
                $result = 'پرداخت شده';
                break;

            case 2:
                $result = 'باطل شده';
                break;

            default:
                $result = 'برگشت داده شده';
        }

        return $result;
    }

    public function getPaymentTypeValueAttribute()
    {
        switch ($this->payment_type) {
            case 0:
                $result = 'آنلاین';
                breake;

            case 1:
                $result = 'آفلاین';
                breake;

            default:
                $result = 'در محل';
        }

        return $result;
    }

    public function getDeliveryStatusValueAttribute()
    {
        switch ($this->delivery_status) {
            case 0:
                $result = 'ارسال نشده';
                breake;

            case 1:
                $result = 'در حال ارسال';
                breake;

            case 2:
                $result = 'ارسال شده';
                breake;

            default:
                $result = 'تحویل داده شده';
        }

        return $result;
    }

    public function getOrderStatusValueAttribute()
    {
        switch ($this->order_status) {
            case 1:
                $result = 'در انتظار تأیید';
                breake;

            case 2:
                $result = 'تأیید نشده';
                breake;

            case 3:
                $result = 'تأیید شده';
                breake;

            case 4:
                $result = 'باطل شده';
                breake;

            case 5:
                $result = 'مرجوع شده';
                breake;

            default:
                $result = 'بررسی نشده';
        }

        return $result;
    }
}
