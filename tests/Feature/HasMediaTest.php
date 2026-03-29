<?php

declare(strict_types=1);

namespace Erp\MediaPackage\Tests\Feature;

use Erp\MediaPackage\Models\Media;
use Erp\MediaPackage\Traits\HasMedia;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Events\Dispatcher;
use PHPUnit\Framework\TestCase;

final class HasMediaTest extends TestCase
{
    private Capsule $db;

    protected function setUp(): void
    {
        parent::setUp();

        $container = new Container();
        Container::setInstance($container);

        $this->db = new Capsule($container);
        $this->db->addConnection([
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $this->db->setEventDispatcher(new Dispatcher($container));
        $this->db->setAsGlobal();
        $this->db->bootEloquent();

        $schema = $this->db->schema();

        $schema->create('articles', function ($table): void {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->timestamps();
        });

        $schema->create('media', function ($table): void {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('related_model_type')->nullable();
            $table->uuid('related_model_id')->nullable();
            $table->timestamps();

            $table->index(['related_model_type', 'related_model_id']);
        });
    }

    public function test_attach_media_updates_polymorphic_columns(): void
    {
        $article = Article::query()->create([
            'id' => '9ab53963-30f5-4244-95f8-8adf252f6ffe',
            'title' => 'Contract testing',
        ]);

        Media::query()->create([
            'id' => '9f2aaf48-58e2-473a-8eb5-47f621271cc6',
            'name' => 'manual.pdf',
        ]);

        $attached = $article->attachMedia('9f2aaf48-58e2-473a-8eb5-47f621271cc6');

        self::assertSame($article->getMorphClass(), $attached->related_model_type);
        self::assertSame($article->id, $attached->related_model_id);
        self::assertCount(1, $article->media()->get());
    }

    public function test_detach_media_clears_polymorphic_columns(): void
    {
        $article = Article::query()->create([
            'id' => '2d8850e3-2a6c-4663-a02f-03b89f00abf9',
            'title' => 'Detach test',
        ]);

        Media::query()->create([
            'id' => 'b6b319eb-45fa-4d0f-a122-5f1af70f80c8',
            'name' => 'photo.jpg',
        ]);

        $article->attachMedia('b6b319eb-45fa-4d0f-a122-5f1af70f80c8');
        $article->detachMedia('b6b319eb-45fa-4d0f-a122-5f1af70f80c8');

        $detached = Media::query()->findOrFail('b6b319eb-45fa-4d0f-a122-5f1af70f80c8');

        self::assertNull($detached->related_model_type);
        self::assertNull($detached->related_model_id);
        self::assertCount(0, $article->media()->get());
    }
}

final class Article extends Model
{
    use HasMedia;

    protected $table = 'articles';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];
}
