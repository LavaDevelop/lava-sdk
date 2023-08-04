<?php

namespace Test\Lava\Api\Mocks\Client;

use Lava\Api\Contracts\Client\ClientContract;

class ClientSuccessResponseMock implements ClientContract
{

    /**
     * @param array $data
     * @return array
     */
    public function createRefund(array $data): array
    {
        return [
            'data' => [
                'status' => 'success',
                'refund_id' => '5b7d4464-d375-41d4-95b1-bb9786fbbac6',
                'amount' => 10.53,
                'service' => 'card',
                'label' => 'Банковская карта'
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function getRefundStatus(array $data): array
    {
        return [
            'data' => [
                'status' => 'success',
                'refund_id' => '5b7d4464-d375-41d4-95b1-bb9786fbbac6',
                'amount' => 10.53,
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function createInvoice(array $data): array
    {
        return [
            'data' => [
                'id' => '01fc840d-a0b1-43ca-b65d-ca713d8a1f95',
                'amount' => 300,
                'expired' => '2022-11-07 13:46:37',
                'status' => 0,
                'shop_id' => uniqid('', true),
                'url' => "https:\/\/pay.lava.ru\/invoice\/01fc840d-a0b1-43ca-b65d-ca713d8a1f95",
                'comment' => null,
                'merchantName' => 'name',
                'exclude_service' => null,
                'include_service' => null
            ],
            'status' => 200,
            'status_check' => true,
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function getInvoiceStatus(array $data): array
    {
        return [
            'data' => [
                'status' => 'created',
                'error_message' => null,
                'id' => '01fc840d-a0b1-43ca-b65d-ca713d8a1f95',
                'shop_id' => '4e48b574-48c4-4d35-a64d-6a0bb169d4fb',
                'amount' => 300,
                'expire' => '2022-11-07 13:46:37',
                'order_id' => '6368c5ed3e7521.67590325',
                'fail_url' => null,
                'success_url' => null,
                'hook_url' => null,
                'custom_fields' => null,
                'include_service' => null,
                'exclude_service' => null,
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function getShopBalance(array $data): array
    {
        return [
            'data' => [
                'balance' => 37500.08,
                'freeze_balance' => 375000.08
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function createPayoff(array $data): array
    {
        return [
            'data' => [
                'payoff_id' => 'cc3bcb98-5c10-4eeb-8aab-1da96e6575c2',
                'payoff_status' => 'created',
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function getPayoffStatus(array $data): array
    {
        return [
            'data' => [
                'id' => 'cc3bcb98-5c10-4eeb-8aab-1da96e6575c1',
                'orderId' => '636915c4707440',
                'status' => 'success',
                'wallet' => null,
                'service' => 'lava_payoff',
                'amountPay' => 10,
                'commission' => 0,
                'amountReceive' => 10,
                'tryCount' => 1,
                'errorMessage' => null
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function createH2hInvoice(array $data): array
    {
        return [
            'data' => [
                'url' => 'https://lava.ru/tds?t=f109ddc5-e65c-a3b4-6f7a-579ee7f8b452',
                'invoiceId' => '681b780b-cb7e-430b-a503-b7aefb834399',
                'cardMask' => '553691******8079',
                'amount' => 100,
                'amountPay' => 100,
                'commission' => 5,
                'shopId' => uniqid('', true)
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function createH2hSbp(array $data): array
    {
        return [
            'data' => [
                'sbp_url' => 'https://pay.lava.ru/sbp/f78ea11f-cd8a-4752-b8b1-36bc312ff886',
                'fingerprint' => false,
                'qr_code' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAM0AAADNCAIAAACU3mM+AAAABnRSTlMA/wD/AP83WBt9AAAACXBIWXMAAA7EAAAOxAGVKw4bAAAEpElEQVR4nO3dy47jNhRF0VSQ///lzlwDBgQvt+XKWtO2Kbnr4IKU+Pj58+fPX3DZ35++Af4X5IyCnFGQMwpyRkHOKMgZBTmjIGcU5IyCnFGQMwpyRkHOKMgZBTmjIGcU5IyCnFH45+TLPz8/U/ex9ljE8LjuyRKHdVNbF8ruav3he05+kXpGQc4oyBkFOaNwNA54GFxyPNi3XTe1vueTDvjgGGKrqXf+FdQzCnJGQc4oyBmFyXHAw1Yv8t7T83WfeqvltZNBQ/bCY+3e5lHqGQU5oyBnFOSMwsVxwKcMdqKzuT3r6w7+ok9RzyjIGQU5oyBnFL5yHHDyiH9t8Kn94FKDX0A9oyBnFOSMgpxRuDgOuPfY+qSbPDi5/t5wZPC/7iUvD9QzCnJGQc4oyBmFyXHAp55ib/XHT1bknqzXvXdX66ZeQj2jIGcU5IyCnFH4ecnz4kGDc3tOFtm+c0fST1HPKMgZBTmjIGcULp4fMPjYenCt7zsfl69t/fzBkc3JbTyoZxTkjIKcUZAzCpPvA+49ts5aXrt3BsBg9/ydbxrUMwpyRkHOKMgZhcn3Afcm1WzdxrrlrX99tLy1QdDaS7b1f7g3LFDPKMgZBTmjIGcUvvJ9wFp2cu/g8t13fneQekZBzijIGQU5ozC5X1DW8X/JfPn1hR4+dd3BpqwP4O3kjIKcUZAzCt/xPmDrQtkenNlw5N4PzKhnFOSMgpxRkDMKR+OAe/3xb9wx/yU3+ZINgh7UMwpyRkHOKMgZhYvnCa9lj+nvPT1fryLeMrim4Z0rkNUzCnJGQc4oyBmFt5wnvNU9H5xUkxnsvJ9caHAu0xb1jIKcUZAzCnJG4WPrAwb7pw/39u/c8ql1Ce9cPaCeUZAzCnJGQc4odOcHbO22v9VdHTxteH0bJ+7d5Nrg+uQT6hkFOaMgZxTkjMLFeUGDx4rdu43s1N97Lx7eeYDwg3pGQc4oyBkFOaNw8fyAe6dfbcnODzi57qf2WL333Qf1jIKcUZAzCnJGodsvKHtOfe8Q4MG3FFsf3poWNTj+MC+ILyNnFOSMgpxROBoHDPYTPzV75yVnD2w5GZ1YH8BvJmcU5IyCnFGY3C/oP670oWfrD9mCgHs97neeGLymnlGQMwpyRkHOKEzuF/QwuAJgcPrKyXVfsphg/d0t2aoF9YyCnFGQMwpyRqF7HzBocAzxkl2MPvVd84L4VeSMgpxRkDMKF98HDDo5e2Cr5ZOm3tnT3/rwvT+oekZBzijIGQU5o3Bx39AT92bC3FuBPLirz5aTdcInTW1RzyjIGQU5oyBnFC7uG5pNuVk39ZLzA7Y+nB2ukFHPKMgZBTmjIGcUuvMDBp08pr93fsC9DZEGf+/WhQapZxTkjIKcUZAzCl85Dthyb4rRQ7YgYN3T/9RrmDX1jIKcUZAzCnJG4eI44F4f86RrP/h6YN3ylsHJS9nEpy3qGQU5oyBnFOSMwuQ44CVdzodPHQ12r+Vs+9LBWUPqGQU5oyBnFOSMwleeH8DXUc8oyBkFOaMgZxTkjIKcUZAzCnJGQc4oyBkFOaMgZxTkjIKcUZAzCnJGQc4oyBkFOaPwLwBAzrdcDGGbAAAAAElFTkSuQmCC'
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function checkWallet(array $data): array
    {
        return [
            'data' => [
                'status' => true,
            ],
            'status' => 200,
            'status_check' => true
        ];
    }

    public function getPayoffTariffs(array $data): array
    {
        return [];
    }
}