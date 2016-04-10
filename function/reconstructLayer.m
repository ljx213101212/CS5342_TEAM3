function [I_reflection, I_background] = reconstructLayer(image, G, E_reflection, E_background)
% reconstruct layer (2.4) by iterative reweighted least square
% @param image: warped image
% @param G: derivative filter matrix
% @param E_reflection: flags for reflection layer
% @param E_background: flags for background layer
% RETURN I_reflection: reflection layer
%        I_background: background layer

    w1 = 50;
    w2 = 1;

    [rows, cols]=size(image);
    img_size = rows * cols;

    Gx = G.Gx;
    Gy = G.Gy;
    Gxx = G.Gxx;
    Gyy = G.Gyy;

    A1=[Gx; Gy; Gxx; Gyy];
    A=[A1; A1];
    b = [zeros(size(A1, 1), 1); A1 * image(:)];
    f1 = [ones(img_size * 2, 1) * w1; ...
          w2 * ones(img_size * 2,1); ...
          w2*ones(img_size, 1)];
    f2 = f1;
    f1([E_reflection, E_reflection + img_size]) = 0;
    f1([E_background, E_background + img_size]) = 100;
    f2([E_reflection, E_reflection + img_size]) = 100;
    f2([E_background, E_background + img_size]) = 0;

    f1([E_background + img_size*2, E_background + img_size*3, E_background + img_size*4]) = 4;
    f2([E_reflection + img_size*2, E_reflection + img_size*3, E_reflection + img_size*4]) = 4;
    f=[f1 ; f2];

    ridx1 = find(sum(A ~= 0, 2) == 0);
    ridx2 = find(f == 0);
    idx = setdiff(1 : size(A,1), [ridx1 ; ridx2]);
    A = A(idx, :);
    b = b(idx, :);
    f = f(idx);
    oA = A;
    ob = b;

    % cost function
    df = spdiags(f, 0, length(f), length(f));
    A = df * oA;
    b = df * ob;
    x = (A'*A) \ (A'*b);
    % iteration
    for iteration_times = 1 : 3
          e = abs(oA*x - ob);
          e = max(e, 0.00001);
          e = 1 ./ e;
          E = spdiags(e, 0, length(f), length(f));
          x = (A' * E * A) \ (A' * E * b);  
    end

    I_reflection = reshape(x, rows, cols);
    I_background = image - I_reflection;

end
