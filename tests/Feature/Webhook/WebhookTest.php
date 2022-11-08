<?php

namespace Feature\Webhook;

use JsonException;
use Lava\Api\Http\LavaFacade;
use PHPUnit\Framework\TestCase;

class WebhookTest extends TestCase
{

    /**
     * @return void
     * @throws JsonException
     */
    public function testWebhook(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);
        $additionalKey = 'f4b91efb9b8da35737fcd97ab123c74566f9a654';
        $signature = 'b0b011552beb994cc04401e088db7b296796a07fc76976b632518fe146ffa330';
        $data = [
            'invoice_id' => '18cf0c0b-6539-4d7c-b3e9-479e4922b87c',
            'status' => 'success',
            'pay_time' => '2022-11-08 11:26:46',
            'amount' => '1.00',
            'order_id' => '636a3c2f3e82b',
            'pay_service' => 'card',
            'payer_details' => '553691******8079',
            'custom_fields' => 'test',
            'type' => 1,
            'credited' => '1.00'
        ];

        $facade = new LavaFacade($shopId, $secretKey, $additionalKey);
        $isTrue = $facade->checkSignWebhook(json_encode($data, JSON_THROW_ON_ERROR), $signature);
        $this->assertTrue($isTrue);
    }

}