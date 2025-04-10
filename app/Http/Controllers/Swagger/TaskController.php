<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * @OA\Get(
 *     path="/api/tasks",
 *     summary="Список задач",
 *     tags={"Tasks"},
 *     @OA\Parameter(
 *          description="Поиск по названию задачи",
 *          in="query",
 *          name="search",
 *          required=false,
 *          @OA\Schema(
 *              type="string",
 *              example="Задача1"
 *          )
 *     ),
 *     @OA\Parameter(
 *           description="Сортировка по полям due_date или created_at",
 *           in="query",
 *           name="sort",
 *           required=false,
 *           @OA\Schema(
 *               type="string",
 *               enum={"due_date", "created_at"},
 *               example="due_date"
 *           )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="array", @OA\Items(
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="title", type="string", example="Some title"),
 *                 @OA\Property(property="description", type="string", example="Some description"),
 *                 @OA\Property(property="due_date", type="string", format="date-time", example="2025-01-20T15:00:00"),
 *                 @OA\Property(property="status", type="string", enum={"выполнена", "не выполнена"}, example="не выполнена"),
 *                 @OA\Property(property="priority", type="string", enum={"низкий", "средний", "высокий"}, example="средний"),
 *                 @OA\Property(property="category", type="string", enum={"работа", "дом", "личное"}, example="работа"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-20T15:00:00"),
 *             )),
 *             @OA\Property(property="meta", type="object",
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="last_page", type="integer", example=5),
 *                 @OA\Property(property="per_page", type="integer", example=10),
 *                 @OA\Property(property="total", type="integer", example=50),
 *             )
 *          )
 *      )
 * ),
 *
 * @OA\Post(
 *      path="/api/tasks",
 *      summary="Создание задачи",
 *      tags={"Tasks"},
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(
 *              allOf={
 *                  @OA\Schema(
 *                      @OA\Property(property="title", type="string", example="Some title"),
 *                      @OA\Property(property="description", type="string", example="Some description"),
 *                      @OA\Property(property="due_date", type="string", format="date-time", example="2025-01-01T15:00:00"),
 *                      @OA\Property(property="status", type="string", enum={"выполнена", "не выполнена"}, example="не выполнена"),
 *                      @OA\Property(property="priority", type="string", enum={"низкий", "средний", "высокий"}, example="средний"),
 *                      @OA\Property(property="category", type="string", enum={"работа", "дом", "личное"}, example="работа")
 *                  )
 *              }
 *          ),
 *      ),
 *      @OA\Response(
 *          response=201,
 *          description="Task created successfully",
 *          @OA\JsonContent(
 *              @OA\Property(property="data", type="object",
 *                  @OA\Property(property="id", type="integer", example="1"),
 *                  @OA\Property(property="title", type="string", example="Some title"),
 *                  @OA\Property(property="description", type="string", example="Some description"),
 *                  @OA\Property(property="due_date", type="string", format="date-time", example="2025-01-20T15:00:00"),
 *                  @OA\Property(property="status", type="string", enum={"выполнена", "не выполнена"}, example="не выполнена"),
 *                  @OA\Property(property="priority", type="string", enum={"низкий", "средний", "высокий"}, example="средний"),
 *                  @OA\Property(property="category", type="string", enum={"работа", "дом", "личное"}, example="работа"),
 *                  @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-20T15:00:00"),
 *              )
 *           )
 *       )
 *  ),
 *
 * @OA\Get(
 *     path="/api/tasks/{task}",
 *     summary="Задачa по ID",
 *     tags={"Tasks"},
 *     @OA\Parameter(
 *         description="ID поста",
 *         in="path",
 *         name="task",
 *         required=true,
 *         example=1
 *      ),
 *      @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example="1"),
 *                 @OA\Property(property="title", type="string", example="Some title"),
 *                 @OA\Property(property="description", type="string", example="Some description"),
 *                 @OA\Property(property="due_date", type="string", format="date-time", example="2025-01-20T15:00:00"),
 *                 @OA\Property(property="status", type="string", enum={"выполнена", "не выполнена"}, example="не выполнена"),
 *                 @OA\Property(property="priority", type="string", enum={"низкий", "средний", "высокий"}, example="средний"),
 *                 @OA\Property(property="category", type="string", enum={"работа", "дом", "личное"}, example="работа"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-20T15:00:00"),
 *             )
 *          )
 *      )
 *  ),
 *
 * @OA\Put(
 *      path="/api/tasks/{task}",
 *      summary="Обновление задачи по ID",
 *      tags={"Tasks"},
 *      @OA\Parameter(
 *          description="ID поста",
 *          in="path",
 *          name="task",
 *          required=true,
 *          example=1
 *       ),
 *       @OA\RequestBody(
 *           required=true,
 *           @OA\JsonContent(
 *               allOf={
 *                   @OA\Schema(
 *                       @OA\Property(property="title", type="string", example="Some title"),
 *                       @OA\Property(property="description", type="string", example="Some description edited"),
 *                       @OA\Property(property="due_date", type="string", format="date-time", example="2025-01-01T15:00:00"),
 *                       @OA\Property(property="status", type="string", enum={"выполнена", "не выполнена"}, example="не выполнена"),
 *                       @OA\Property(property="priority", type="string", enum={"низкий", "средний", "высокий"}, example="средний"),
 *                       @OA\Property(property="category", type="string", enum={"работа", "дом", "личное"}, example="дом")
 *                   )
 *               }
 *           )
 *       ),
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Task updated successfully"),
 *          )
 *       )
 *   ),
 *
 * @OA\Delete(
 *      path="/api/tasks/{task}",
 *      summary="Удаление задачи по ID",
 *      tags={"Tasks"},
 *      @OA\Parameter(
 *          description="ID поста",
 *          in="path",
 *          name="task",
 *          required=true,
 *          example=1
 *       ),
 *       @OA\Response(
 *          response=200,
 *          description="Ok",
 *          @OA\JsonContent(
 *              @OA\Property(property="message", type="string", example="Task deleted successfully"),
 *           )
 *       )
 *   )
 */
class TaskController extends Controller
{

}
