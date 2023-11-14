<?php

namespace Magebit\Faq\Model;

use Magebit\Faq\Api\Data\FaqModelInterface;
use Magebit\Faq\Model\ResourceModel\FaqResourceModel;
use Magento\Framework\Api\AttributeValue;
use Magento\Framework\Model\AbstractModel;

/**
 * Model class for Faq entity
 */
class FaqModel extends AbstractModel implements FaqModelInterface
{
    const MAIN_TABLE_NAME = 'magebit_faq';
    const KEY_ID = 'id';
    const KEY_QUESTION = 'question';
    const KEY_ANSWER = 'answer';
    const KEY_STATUS = 'status';
    const KEY_POSITION = 'position';
    const KEY_UPDATED_AT = 'updated_at';
    const ATTRIBUTES = [
        self::KEY_ID,
        self::KEY_QUESTION,
        self::KEY_ANSWER,
        self::KEY_STATUS,
        self::KEY_POSITION,
        self::KEY_UPDATED_AT,
    ];

    /**
     * Links model to resourceModel
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(FaqResourceModel::class);
    }

    /**
     * Retrieve faq id.
     *
     * @return int|null
     */
    public function getId(): int|null
    {
        return $this->_getData(self::KEY_ID);
    }

    /**
     * Does not work, let DB handle IDs
     *
     * @param $value
     * @return void
     */
    public function setId($value) {}

    /**
     * Get faq question
     *
     * @return string|null
     */
    public function getQuestion(): string|null
    {
        return $this->_getData(self::KEY_QUESTION);
    }

    /**
     * Set faq question
     *
     * @param string $question
     * @return $this
     */
    public function setQuestion(string $question): FaqModelInterface
    {
        $this->setData(self::KEY_QUESTION, $question);
        return $this;
    }

    /**
     * Get faq answer
     *
     * @return string|null
     */
    public function getAnswer(): string|null
    {
        return $this->_getData(self::KEY_ANSWER);
    }

    /**
     * Set faq answer
     *
     * @param string $answer
     * @return $this
     */
    public function setAnswer(string $answer): FaqModelInterface
    {
        $this->setData(self::KEY_ANSWER, $answer);
        return $this;
    }

    /**
     * Get faq status
     *
     * @return string 0 = inactive, 1 = active
     */
    public function getStatus(): string
    {
        return $this->_getData(self::KEY_STATUS);
    }

    /**
     * Set faq status
     *
     * @param int|string $status 0 = inactive, 1 = active
     * @return $this
     */
    public function setStatus(int|string $status): FaqModelInterface
    {
        $this->setData(self::KEY_STATUS, (string)$status);
        return $this;
    }

    /**
     * Get faq position
     *
     * @return string
     */
    public function getPosition(): string
    {
        return $this->_getData(self::KEY_POSITION);
    }

    /**
     * Set faq position
     *
     * @param int $position
     * @return $this
     */
    public function setPosition(int $position): FaqModelInterface
    {
        $this->setData(self::KEY_POSITION, $position);
        return $this;
    }

    /**
     * Retrieve faq last update date and time.
     *
     * @return string|null
     */
    public function getUpdatedAt(): string|null
    {
        return $this->_getData(self::KEY_UPDATED_AT);
    }

    /**
     * Retrieve custom attributes
     *
     * @return AttributeValue[]
     */
    public function getCustomAttributes(): array
    {
        $attributes = [];
        foreach(self::ATTRIBUTES as $attribute) {
            $attributes[] = new AttributeValue([
                'attribute_code' => $attribute,
                'value' => $this->_getData($attribute)
            ]);
        }

        return $attributes;
    }
}
