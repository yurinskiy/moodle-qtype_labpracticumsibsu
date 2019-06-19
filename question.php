<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Lab Practicum (SibSU) question definition class.
 *
 * @package    qtype
 * @subpackage labpracticumsibsu
 * @copyright  2009 The Open University
 * @copyright  2019 Yuriy Yurinskiy {@link https://yuriyyurinskiy.ru}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/question/type/questionbase.php');

/**
 * Represents a Lab Practicum (SibSU) question.
 *
 * @copyright  2009 The Open University
 * @copyright  2019 Yuriy Yurinskiy {@link https://yuriyyurinskiy.ru}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class qtype_labpracticumsibsu_question extends question_graded_by_strategy
        implements question_response_answer_comparer
{
    public function __construct()
    {
        parent::__construct(new question_first_matching_answer_grading_strategy($this));
    }

    public function get_expected_data()
    {
        return [
                'answer' => PARAM_RAW_TRIMMED
        ];
    }

    /**
     * Создайте текстовое резюме ответа.
     * @param array $response - ответ, который можно передать в {@link grade_response()}.
     * @return string - текстовое резюме этого ответа, которое можно использовать в отчетах.
     */
    public function summarise_response(array $response)
    {
        if (isset($response['answer'])) {
            return $response['answer'];
        } else {
            return null;
        }
    }

    /**
     * Используется многими способами поведения, чтобы определить,
     * является ли ответ ученика на вопрос завершенным. То есть,
     * должна ли попытка вопроса перейти в состояние ЗАВЕРШЕНО или НЕПОЛНО.
     *
     * @param array $response ответы, возвращаемые
     *      {@link question_attempt_step::get_qt_data()}.
     * @return bool является ли этот ответ полным ответом на этот вопрос.
     */
    public function is_complete_response(array $response)
    {
        return array_key_exists('answer', $response) &&
                ($response['answer'] || $response['answer'] === '0');
    }

    /**
     * Используйте многие из вариантов поведения, чтобы определить,
     * предоставил ли студент достаточно ответа для автоматической оценки вопроса
     * или его следует считать отмененным.
     *
     * @param array $response ответы, возвращаемые
     *      {@link question_attempt_step::get_qt_data()}.
     * @return bool может ли этот ответ быть оценен.
     */
    public function is_gradable_response(array $response)
    {
        return $this->is_complete_response($response);
    }

    /** @noinspection PhpDocMissingThrowsInspection */
    /**
     * В ситуациях, когда is_gradable_response ) возвращает false,
     * этот метод должен генерировать описание проблемы.
     * @param array $response
     * @return string сообщение.
     */
    public function get_validation_error(array $response)
    {
        if ($this->is_gradable_response($response)) {
            return '';
        }

        return get_string('pleaseenterananswer', 'qtype_labpracticumsibsu');
    }

    /**
     * Используйте многие из поведений, чтобы определить, изменился ли ответ учащегося.
     * Обычно это используется для определения того, что новый набор ответов можно безопасно отбросить.
     *
     * @param array $prevResponse ранее записанные ответы на этот вопрос,
     *      возвращенные {@link question_attempt_step::get_qt_data()}
     * @param array $newResponse новые ответы, в том же формате.
     * @return bool одинаковы ли два набора ответов - то есть
     *      можно ли безопасно отбрасывать новый набор ответов.
     */
    public function is_same_response(array $prevResponse, array $newResponse)
    {
        return question_utils::arrays_same_at_key_missing_is_blank(
                $prevResponse, $newResponse, 'answer');
    }

    /** @return array of {@link question_answers}. */
    public function get_answers()
    {
        // Возвращает массив правильных ответов
        return [
                new question_answer(
                        1,
                        "0533991565dbe2bd422541b1a3eb3e77a3702e16",
                        1,
                        "",
                        1
                )
        ];
    }

    /**
     * @param array $response the response.
     * @param question_answer $answer an answer.
     * @return bool whether the response matches the answer.
     */
    public function compare_response_with_answer(array $response, question_answer $answer)
    {
        // Возвращаем false, если не введен ответ
        if (!array_key_exists('answer', $response) || is_null($response['answer'])) {
            return false;
        }

        return question_utils::arrays_same_at_key_missing_is_blank(
                $response, (array)$answer, 'answer');
    }
}
