<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property-read \App\Models\Module|null $module
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserProgress> $userProgress
 * @property-read int|null $user_progress_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chapter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chapter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Chapter query()
 */
	class Chapter extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Chapter> $chapters
 * @property-read int|null $chapters_count
 * @property-read mixed $total_chapters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Quiz> $quizzes
 * @property-read int|null $quizzes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module query()
 */
	class Module extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QuizAttempt> $attempts
 * @property-read int|null $attempts_count
 * @property-read \App\Models\Module|null $module
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QuizQuestion> $questions
 * @property-read int|null $questions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Quiz query()
 */
	class Quiz extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\Quiz|null $quiz
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizAttempt query()
 */
	class QuizAttempt extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\Quiz|null $quiz
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|QuizQuestion query()
 */
	class QuizQuestion extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Chapter> $completedChapters
 * @property-read int|null $completed_chapters_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserProgress> $progress
 * @property-read int|null $progress_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\QuizAttempt> $quizAttempts
 * @property-read int|null $quiz_attempts_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\Chapter|null $chapter
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProgress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProgress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|UserProgress query()
 */
	class UserProgress extends \Eloquent {}
}

