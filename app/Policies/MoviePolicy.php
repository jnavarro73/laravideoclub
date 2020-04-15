<?php

namespace App\Policies;

use App\Movie;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any movies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the movie.
     *
     * @param  \App\User  $user
     * @param  \App\Movie  $movie
     * @return mixed
     */
    public function view(User $user, Movie $movie)
    {
        //
    }

    /**
     * Determine whether the user can create movies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the movie.
     *
     * @param  \App\User  $user
     * @param  \App\Movie  $movie
     * @return mixed
     */
    public function update(User $user, Movie $movie)
    {
        //TODO cuando user pueda meter n pelis, miraré que el update puedan 
        // hacer superadministrador y el usuario creador, para eso he de 
        // crear campo creador en movie y tabla de roles
        // de momento miro solo que sea el user numero 2 ,
        //return true;
        return ($user->id === 2);
        //dd($user->id);
    }

    /**
     * Determine whether the user can delete the movie.
     *
     * @param  \App\User  $user
     * @param  \App\Movie  $movie
     * @return mixed
     */
    public function delete(User $user, Movie $movie)
    {
        //
    }

    /**
     * Determine whether the user can restore the movie.
     *
     * @param  \App\User  $user
     * @param  \App\Movie  $movie
     * @return mixed
     */
    public function restore(User $user, Movie $movie)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the movie.
     *
     * @param  \App\User  $user
     * @param  \App\Movie  $movie
     * @return mixed
     */
    public function forceDelete(User $user, Movie $movie)
    {
        //
    }
}
