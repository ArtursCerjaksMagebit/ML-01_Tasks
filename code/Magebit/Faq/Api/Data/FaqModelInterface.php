<?php

namespace Magebit\Faq\Api\Data;

interface FaqModelInterface
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
    /**#@-*/

    /**
     * Retrieve faq id.
     *
     * @return mixed
     */
    public function getId(): mixed;

    /**
     * Get faq question
     *
     * @return string|null
     */
    public function getQuestion(): string|null;

    /**
     * Set faq question
     *
     * @param string $question
     * @return $this
     */
    public function setQuestion(string $question): FaqModelInterface;

    /**
     * Get faq answer
     *
     * @return string|null
     */
    public function getAnswer(): string|null;

    /**
     * Set faq answer
     *
     * @param string $answer
     * @return $this
     */
    public function setAnswer(string $answer): FaqModelInterface;

    /**
     * Get faq status
     *
     * @return int 0 = inactive, 1 = active
     */
    public function getStatus(): int;

    /**
     * Set faq status
     *
     * @param int $status 0 = inactive, 1 = active
     * @return $this
     */
    public function setStatus(int $status): FaqModelInterface;

    /**
     * Get faq position
     *
     * @return int|null
     */
    public function getPosition(): int|null;

    /**
     * Set faq position
     *
     * @param int $position
     * @return $this
     */
    public function setPosition(int $position): FaqModelInterface;

    /**
     * Retrieve faq last update date and time.
     *
     * @return string|null
     */
    public function getUpdatedAt(): string|null;
}
