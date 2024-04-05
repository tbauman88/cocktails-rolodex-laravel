<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function drinks(): HasMany
    {
        return $this->hasMany(Drink::class);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, 'user_ingredients')
            ->withPivot('brand', 'category', 'sub_category')
            ->withTimestamps();
    }

    public function favouriteDrinks(): BelongsToMany
    {
        return $this->belongsToMany(Drink::class, 'user_drinks')->withTimestamps();
    }

    public function toggleDrink(Drink $drink): void
    {
        if ($this->favouriteDrinks()->where('drink_id', $drink->id)->exists()) {
            $this->favouriteDrinks()->detach($drink->id);
            $drink->decrement('save_count');
            return;
        }

        $this->favouriteDrinks()->attach($drink->id);
        $drink->increment('save_count');
    }

    public function suggestedCocktails(): Collection
    {
        $suggested = Drink::whereDoesntHave('ingredients', function ($query) {
            $query->whereNotIn('ingredients.id', $this->ingredients->pluck('id')->toArray());
        })->get();

        dump('suggestedCocktails', $suggested->toArray());

        return $suggested;
    }

    public function recommendedCocktails(): Collection
    {
        $userIngredientIds = $this->ingredients->pluck('id');

        $recommended = Drink::whereHas('ingredients', function ($query) use ($userIngredientIds) {
            $query->whereNotIn('ingredients.id', $userIngredientIds);
        }, '>', 0)
            ->with(['ingredients' => fn($query) => $query->whereNotIn('ingredients.id', $userIngredientIds)])
            ->get()
            ->map(fn($drink) => [
                'drink' => $drink->name,
                'missing_ingredients' => $drink->ingredients->pluck('name')->toArray(),
            ]);

        dump('recommendedCocktails', $recommended->toArray());


        return $recommended;
    }
}
