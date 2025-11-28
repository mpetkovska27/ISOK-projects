
    <label>Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $book->title ?? '') }}">



    <label>Author</label>
    <input type="text" name="author" class="form-control" value="{{ old('author', $book->author ?? '') }}">


    <label>Year Published</label>
    <input type="number" name="year" class="form-control" value="{{ old('year', $book->year ?? '') }}">


    <label>ISBN</label>
    <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn ?? '') }}">

    <label>Genre</label>
    <input type="text" name="genre" class="form-control" value="{{ old('genre', $book->genre ?? '') }}">

    <label>Borrowed By</label>
    <input type="text" name="borrowed_by" class="form-control" value="{{ old('borrowed_by', $book->borrowed_by ?? '') }}">

    <label>Date Borrowed</label>
    <input type="date" name="borrow_date" class="form-control" value="{{ old('borrow_date', $book->borrow_date ?? '') }}">

    <label>Date Returned</label>
    <input type="date" name="return_date" class="form-control" value="{{ old('return_date', $book->return_date ?? '') }}">

