<?php

namespace Feature\Course;

use JsonException;
use Lava\Api\Dto\Response\Course\CourseDto;
use Lava\Api\Dto\Response\Course\CurrencyDto;
use Lava\Api\Exceptions\BaseException;
use Lava\Api\Exceptions\Course\CourseException;
use Lava\Api\Http\LavaFacade;
use PHPUnit\Framework\TestCase;
use Test\Lava\Api\Mocks\Client\ClientErrorResponseMock;
use Test\Lava\Api\Mocks\Client\ClientSuccessResponseMock;

class CourseTest extends TestCase
{
    /**
     * @throws JsonException
     * @throws BaseException
     */
    public function testGetPayoffCourseListSuccess(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);

        $mockClient = new ClientSuccessResponseMock();

        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $list = $facade->getPayoffCourseList();

        $this->validate($list);
    }

    /**
     * @throws BaseException
     * @throws JsonException
     */
    public function testGetPaymentCourseListSuccess(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);

        $mockClient = new ClientSuccessResponseMock();

        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);
        $list = $facade->getPaymentCourseList();

        $this->validate($list);
    }

    /**
     * @throws BaseException
     * @throws JsonException
     */
    public function testGetPaymentCourseListFailed(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);

        $mockClient = new ClientErrorResponseMock();

        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);

        $this->expectException(CourseException::class);
        $facade->getPaymentCourseList();
    }

    /**
     * @throws JsonException
     * @throws BaseException
     */
    public function testGetPayoffCourseListFailed(): void
    {
        $shopId = uniqid('', true);
        $secretKey = uniqid('', true);

        $mockClient = new ClientErrorResponseMock();

        $facade = new LavaFacade($secretKey, $shopId, null, $mockClient);

        $this->expectException(CourseException::class);
        $facade->getPaymentCourseList();
    }

    /**
     * @param array<array-key, CourseDto> $list
     * @return void
     */
    private function validate(array $list): void
    {
        $this->assertIsArray($list);

        foreach ($list as $item) {
            $this->assertInstanceOf(CourseDto::class, $item);
            $this->assertInstanceOf(CurrencyDto::class, $item->getCurrency());

            $this->assertIsString($item->getCurrency()->getLabel());
            $this->assertIsString($item->getCurrency()->getSymbol());
            $this->assertIsString($item->getCurrency()->getValue());

            $this->assertIsFloat($item->getValue());
        }
    }
}